from .translations import load_translations

def translation_processor(request):
    """
    Injects translations into every template as 't'.
    """
    lang = request.session.get('language', 'ru')
    translations = load_translations(lang)
    
    # Add common sidebar and page translations if not present in PHP files
    common = {
        'side_info': 'Информация' if lang == 'ru' else 'Ma\'lumot',
        'side_subtitles': 'Субтитры' if lang == 'ru' else 'Subtitrlar',
        'side_materials': 'Материалы' if lang == 'ru' else 'Materiallar',
        'side_creativity': 'Креативность' if lang == 'ru' else 'Kreativlik',
        'm_materials': 'Материалы' if lang == 'ru' else 'Materiallar',
        'm_all': 'Все' if lang == 'ru' else 'Barchasi',
    }
    translations.update(common)
    
    return {
        't': translations,
        'current_lang': lang
    }
