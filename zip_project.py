import zipfile
import os

def zip_directory(path, output_filename):
    exclude_dirs = {'.git', 'venv', '.venv', '__pycache__', '.gemini', '.antigravity', '.cortex'}
    exclude_files = {output_filename, 'db.sqlite3-journal'} # Keep db.sqlite3 as it might have important data
    
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(path):
            # Modify dirs in-place to exclude certain directories
            dirs[:] = [d for d in dirs if d not in exclude_dirs]
            
            for file in files:
                if file in exclude_files:
                    continue
                # Create a relative path for the file in the zip
                file_path = os.path.join(root, file)
                rel_path = os.path.relpath(file_path, path)
                zipf.write(file_path, rel_path)

if __name__ == "__main__":
    zip_directory(".", "Nerman_Project.zip")
    print("Nerman_Project.zip created successfully.")
