import sqlite3
import os

def export_to_sql():
    conn = sqlite3.connect('db.sqlite3')
    cursor = conn.cursor()
    
    output_file = 'php_project/db/data_dump.sql'
    
    with open(output_file, 'w', encoding='utf-8') as f:
        # Categories
        cursor.execute("SELECT id, name, icon, color, slug FROM core_category")
        categories = cursor.fetchall()
        for cat in categories:
            name = cat[1].replace("'", "''")
            f.write(f"INSERT INTO categories (id, name, icon, color, slug) VALUES ({cat[0]}, '{name}', '{cat[2]}', '{cat[3]}', '{cat[4]}');\n")
            
        # Materials
        cursor.execute("SELECT id, category_id, name, image_url, icon, created_at FROM core_material")
        materials = cursor.fetchall()
        for mat in materials:
            name = mat[2].replace("'", "''")
            f.write(f"INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES ({mat[0]}, {mat[1]}, '{name}', '{mat[3]}', '{mat[4]}', '{mat[5]}');\n")
            
        # FAQ
        cursor.execute("SELECT id, question, answer, \"order\" FROM core_faq")
        faqs = cursor.fetchall()
        for faq in faqs:
            q = faq[1].replace("'", "''")
            a = faq[2].replace("'", "''")
            f.write(f"INSERT INTO faqs (id, question, answer, sort_order) VALUES ({faq[0]}, '{q}', '{a}', {faq[3]});\n")
            
        # Team Members
        cursor.execute("SELECT id, name, role, description, avatar_url, linkedin_url, twitter_url, github_url, \"order\" FROM core_teammember")
        team = cursor.fetchall()
        for t in team:
            name = t[1].replace("'", "''")
            desc = t[3].replace("'", "''")
            f.write(f"INSERT INTO team_members (id, name, role, description, avatar_url, linkedin_url, twitter_url, github_url, sort_order) VALUES ({t[0]}, '{name}', '{t[2]}', '{desc}', '{t[4]}', '{t[5]}', '{t[6]}', '{t[7]}', {t[8]});\n")

    conn.close()
    print(f"Data exported to {output_file}")

if __name__ == "__main__":
    export_to_sql()
