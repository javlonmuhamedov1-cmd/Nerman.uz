from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.contrib import messages
from django.contrib.auth.models import User
from .models import FAQ, TeamMember, Category, Material, Chat, ChatMessage, Profile
from django.http import JsonResponse


def splash(request):
    return redirect('landing')


from django.contrib.auth import authenticate, login, logout

def login_page(request):
    if request.user.is_authenticated:
        return redirect('dashboard')
        
    if request.method == 'POST':
        email = request.POST.get('email')
        password = request.POST.get('password')
        
        try:
            # Try to find user by email
            user_obj = User.objects.get(email=email)
            user = authenticate(request, username=user_obj.username, password=password)
            if user:
                login(request, user)
                return redirect('landing')
            else:
                messages.error(request, 'Неверный пароль' if request.LANGUAGE_CODE == 'ru' else 'Noto\'g\'ri parol')
        except User.DoesNotExist:
            # Fallback to username for users created via manage.py or admin
            user = authenticate(request, username=email, password=password)
            if user:
                login(request, user)
                return redirect('landing')
            messages.error(request, 'Пользователь не найден' if request.LANGUAGE_CODE == 'ru' else 'Foydalanuvchi topilmadi')
            
    lang = request.session.get('language', 'ru')
    translations = {
        'page_title': 'Войти' if lang == 'ru' else 'Kirish',
        'password_label': 'Пароль' if lang == 'ru' else 'Parol',
        'no_account_link': 'Нет аккаунта?' if lang == 'ru' else 'Hisobingiz yo\'qmi?',
        'login_btn': 'Войти' if lang == 'ru' else 'Kirish',
        'or_text': 'или' if lang == 'ru' else 'yoki',
        'tg_btn': 'Войти через Telegram' if lang == 'ru' else 'Telegram orqali kirish',
        'switch_lang': "O'zbek tiliga o'tish" if lang == 'ru' else 'Перейти на русский',
        'username_label': 'Имя пользователя' if lang == 'ru' else 'Foydalanuvchi nomi',
    }
    return render(request, "core/login.html", {'trans': translations})

def logout_view(request):
    logout(request)
    return redirect('landing')

def register_page(request):
    if request.user.is_authenticated:
        return redirect('landing')
        
    lang = request.session.get('language', 'ru')
    if request.method == 'POST':
        username = request.POST.get('username')
        email = request.POST.get('email')
        password = request.POST.get('password')
        otp = request.POST.get('otp')
        
        if otp != '555555':
            messages.error(request, 'Неверный код' if lang == 'ru' else "Noto'g'ri kod")
        elif User.objects.filter(username=username).exists():
            messages.error(request, 'Имя пользователя занято' if lang == 'ru' else 'Foydalanuvchi nomi band')
        elif User.objects.filter(email=email).exists():
            messages.error(request, 'Email занят' if lang == 'ru' else 'Email band')
        else:
            user = User.objects.create_user(username=username, email=email, password=password)
            Profile.objects.create(user=user)
            login(request, user)
            messages.success(request, 'Добро пожаловать!' if lang == 'ru' else 'Xush kelibsiz!')
            return redirect('landing')

    translations = {
        'page_title': 'Создать аккаунт' if lang == 'ru' else 'Hisob yaratish',
        'username_label': 'Имя пользователя' if lang == 'ru' else 'Foydalanuvchi nomi',
        'password_label': 'Пароль' if lang == 'ru' else 'Parol',
        'otp_label': 'Одноразовый код' if lang == 'ru' else 'Bir martalik kod',
        'otp_link': 'Получить код на Gmail' if lang == 'ru' else 'Gmail-ga kod olish',
        'create_btn': 'Создать' if lang == 'ru' else 'Yaratish',
        'or_text': 'или' if lang == 'ru' else 'yoki',
        'tg_btn': 'Войти через Telegram' if lang == 'ru' else 'Telegram orqali kirish',
        'have_account': 'Уже есть аккаунт?' if lang == 'ru' else 'Hisobingiz bormi?',
        'switch_lang': "O'zbek tiliga o'tish" if lang == 'ru' else 'Перейти на русский',
        'otp_sending': 'Отправка...' if lang == 'ru' else 'Yuborilmoqda...',
        'otp_sent': 'Код отправлен (555555)' if lang == 'ru' else 'Kod yuborildi (555555)',
        'otp_alert': 'Тестовый код: 555555' if lang == 'ru' else 'Sinov tariqasida kod: 555555',
        'otp_email_alert': 'Пожалуйста, введите ваш email.' if lang == 'ru' else 'Iltimos, avval email manzilingizni kiriting.',
    }
    return render(request, "core/register.html", {'trans': translations})




def landing(request):
    categories = Category.objects.all()
    team_members = TeamMember.objects.all()
    context = {
        'categories': categories,
        'team_members': team_members,
    }
    return render(request, "core/landing.html", context)


def problems(request):
    return render(request, "core/problems.html")


def about(request):
    team_members = TeamMember.objects.all()
    return render(request, "core/about.html", {"team_members": team_members})


def faq(request):
    faqs = FAQ.objects.all()
    return render(request, "core/faq.html", {"faqs": faqs})


@login_required
def dashboard(request):
    profile, created = Profile.objects.get_or_create(user=request.user)
    recent_chats = Chat.objects.filter(user=request.user)[:5]
    context = {
        'profile': profile,
        'recent_chats': recent_chats,
    }
    return render(request, "core/dashboard.html", context)


@login_required
def ai_chat(request, chat_id=None):
    profile, _ = Profile.objects.get_or_create(user=request.user)
    chats = Chat.objects.filter(user=request.user)
    
    active_chat = None
    messages = []
    
    if chat_id:
        active_chat = get_object_or_404(Chat, id=chat_id, user=request.user)
        messages = active_chat.messages.all()
    
    context = {
        'profile': profile,
        'chats': chats,
        'active_chat': active_chat,
        'messages': messages,
    }
    return render(request, "core/ai_chat.html", context)


@login_required
def create_chat(request):
    new_chat = Chat.objects.create(user=request.user)
    return redirect('ai_chat', chat_id=new_chat.id)


def materials(request):
    all_categories = Category.objects.all()
    sub_name = request.GET.get('sub')
    
    if sub_name:
        active_sub = sub_name
        materials_list = Material.objects.filter(category__name=sub_name)
    else:
        # Default to the first category if it exists
        first_cat = all_categories.first()
        if first_cat:
            active_sub = first_cat.name
            materials_list = Material.objects.filter(category=first_cat)
        else:
            active_sub = None
            materials_list = Material.objects.all()
    
    return render(request, "core/materials.html", {
        "all_categories": all_categories,
        "active_sub": active_sub,
        "materials": materials_list,
        "hide_header": True,
        "hide_footer": True,
    })


def transitions(request):
    materials_list = Material.objects.filter(category__slug="transitions")
    return render(request, "core/transitions.html", {
        "materials": materials_list,
        "hide_header": True,
        "hide_footer": True,
    })


def sounds(request):
    materials_list = Material.objects.filter(category__slug="sounds")
    return render(request, "core/sounds.html", {
        "materials": materials_list,
        "hide_header": True,
        "hide_footer": True,
    })


def backgrounds(request):
    materials_list = Material.objects.filter(category__slug="backgrounds")
    return render(request, "core/backgrounds.html", {
        "materials": materials_list,
        "hide_header": True,
        "hide_footer": True,
    })


def material_detail(request, pk):
    material = get_object_or_404(Material, pk=pk)
    related_materials = Material.objects.filter(category=material.category).exclude(pk=pk)[:5]
    return render(request, "core/material_detail.html", {
        "material": material,
        "related_materials": related_materials,
        "hide_header": True,
        "hide_footer": True,
    })


def sound_detail(request, sound_id):
    return render(request, "core/sound_detail.html", {"sound_id": sound_id})


@login_required
def profile(request):
    profile, created = Profile.objects.get_or_create(user=request.user)
    chats_count = Chat.objects.filter(user=request.user).count()
    return render(request, "core/profile.html", {
        "profile": profile,
        "chats_count": chats_count,
    })



def author_profile(request, username):
    # For now, we handle Baxtiyorov specifically for high-fidelity demo
    author_name = "Baxtiyorov"
    author_username = "@thePanTheR23"
    stats = {
        'subscriptions': 44,
        'followers': 77,
        'likes': 99
    }
    return render(request, "core/author_profile.html", {
        "author_name": author_name,
        "author_username": author_username,
        "stats": stats,
        "hide_header": True,
        "hide_footer": True,
    })


def author(request, author_id):
    return render(request, "core/author.html", {"author_id": author_id})


def pricing(request):
    return render(request, "core/pricing.html")


def terms(request):
    return render(request, "core/terms.html")


def privacy(request):
    return render(request, "core/privacy.html")


def contact(request):
    if request.method == 'POST':
        name = request.POST.get('name', '').strip()
        email = request.POST.get('email', '').strip()
        subject = request.POST.get('subject', '').strip()
        message_body = request.POST.get('message', '').strip()
        if name and email and message_body:
            lang = request.session.get('language', 'ru')
            if lang == 'ru':
                messages.success(request, 'Ваше сообщение отправлено! Мы свяжемся с вами в ближайшее время.')
            else:
                messages.success(request, 'Xabaringiz yuborildi! Tez orada siz bilan bog\'lanamiz.')
    return render(request, "core/contact.html")


def set_language(request):
    lang = request.GET.get('lang', 'ru')
    if lang in ['ru', 'uz']:
        request.session['language'] = lang
    return redirect(request.META.get('HTTP_REFERER', 'landing'))
@login_required
def toggle_like(request, pk):
    material = get_object_or_404(Material, pk=pk)
    if material.likes.filter(id=request.user.id).exists():
        material.likes.remove(request.user)
        liked = False
    else:
        material.likes.add(request.user)
        liked = True
    return JsonResponse({'liked': liked, 'count': material.likes.count()})
