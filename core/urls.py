from django.urls import path
from . import views

urlpatterns = [
    path("", views.splash, name="splash"),
    path("login/", views.login_page, name="login"),
    path("register/", views.register_page, name="register"),
    path("logout/", views.logout_view, name="logout"),

    path("landing/", views.landing, name="landing"),
    path("problems/", views.problems, name="problems"),
    path("about/", views.about, name="about"),
    path("faq/", views.faq, name="faq"),
    path("dashboard/", views.dashboard, name="dashboard"),
    path("ai-chat/", views.ai_chat, name="ai_chat"),
    path("ai-chat/<int:chat_id>/", views.ai_chat, name="ai_chat"),
    path("create-chat/", views.create_chat, name="create_chat"),
    path("materials/", views.materials, name="materials"),
    path("materials/transitions/", views.transitions, name="transitions"),
    path("materials/sounds/", views.sounds, name="sounds"),
    path("materials/backgrounds/", views.backgrounds, name="backgrounds"),
    path("material/<int:pk>/", views.material_detail, name="material_detail"),
    path("material/<int:pk>/like/", views.toggle_like, name="toggle_like"),
    path("materials/sounds/<int:sound_id>/", views.sound_detail, name="sound_detail"),
    path("profile/", views.profile, name="profile"),
    path("author-profile/<str:username>/", views.author_profile, name="author_profile"),
    path("author/<int:author_id>/", views.author, name="author"),
    path("pricing/", views.pricing, name="pricing"),
    path("terms/", views.terms, name="terms"),
    path("privacy/", views.privacy, name="privacy"),
    path("contact/", views.contact, name="contact"),
    path("set-language/", views.set_language, name="set_language"),
]
