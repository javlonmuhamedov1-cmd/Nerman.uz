import os

def get_directory_size(path):
    total_size = 0
    for root, dirs, files in os.walk(path):
        for f in files:
            fp = os.path.join(root, f)
            if not os.path.islink(fp):
                total_size += os.path.getsize(fp)
    return total_size

base_dir = r"c:\Users\user\Desktop\Nerman_NEW_disegn"
items = os.listdir(base_dir)

print(f"{'Item':<40} | {'Size (GB)':<10}")
print("-" * 55)

for item in items:
    item_path = os.path.join(base_dir, item)
    if os.path.isdir(item_path):
        size = get_directory_size(item_path)
    else:
        size = os.path.getsize(item_path)
    
    # Only show items larger than 10MB
    if size > 10 * 1024 * 1024:
        print(f"{item:<40} | {size / (1024**3):.2f}")
