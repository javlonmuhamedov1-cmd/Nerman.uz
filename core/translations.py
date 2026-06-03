import re
import os
from django.conf import settings

def load_translations(lang):
    """
    Loads translations from original PHP ruin/uz.php files.
    """
    original_path = os.path.join(settings.BASE_DIR, 'original_source', 'Nerman_Ai-main', 'lang', f'{lang}.php')
    
    if not os.path.exists(original_path):
        return {}
        
    translations = {}
    with open(original_path, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Simple regex to extract 'key' => 'value' from PHP array
    matches = re.finditer(r"'([^']+)'\s*=>\s*'([^']*)'", content)
    for match in matches:
        key, value = match.groups()
        # Handle escaped quotes in PHP strings if any
        value = value.replace("\\'", "'")
        translations[key] = value
        
    return translations
