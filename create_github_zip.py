import zipfile
import os

def create_github_zip(path, output_filename):
    # Exclude patterns
    exclude_dirs = {'.git', 'venv', '.venv', '__pycache__', '.idea', 'original_source'}
    exclude_files = {output_filename, 'db.sqlite3'}
    
    # Specific large subfolders to exclude to keep zip manageable
    exclude_subfolders = {
        os.path.join('static', 'materials'),
        os.path.join('static', 'music'),
    }

    print(f"Creating {output_filename}...")
    
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(path):
            # Calculate relative root for comparison
            rel_root = os.path.relpath(root, path)
            
            # Skip excluded top-level directories
            dirs[:] = [d for d in dirs if d not in exclude_dirs]
            
            # Skip specific large subfolders
            if any(rel_root.startswith(ex) for ex in exclude_subfolders):
                continue

            for file in files:
                # Skip excluded files and any other zip files
                if file in exclude_files or file.endswith('.zip'):
                    continue
                
                file_path = os.path.join(root, file)
                rel_path = os.path.relpath(file_path, path)
                
                # Check if this file is part of an excluded subfolder (double check)
                if any(rel_path.startswith(ex) for ex in exclude_subfolders):
                    continue
                    
                zipf.write(file_path, rel_path)

if __name__ == "__main__":
    create_github_zip(".", "Nerman_GitHub_Upload.zip")
    print("Nerman_GitHub_Upload.zip created successfully.")
    
    size = os.path.getsize("Nerman_GitHub_Upload.zip") / (1024 * 1024)
    print(f"Final Zip Size: {size:.2f} MB")
