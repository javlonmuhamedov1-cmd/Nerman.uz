-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_joined DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Profiles table
CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    nickname VARCHAR(100) DEFAULT '',
    phone VARCHAR(20) DEFAULT '',
    avatar VARCHAR(255) DEFAULT NULL,
    tokens INT DEFAULT 1000,
    subscription_type ENUM('None', 'Pro') DEFAULT 'None',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    icon VARCHAR(10) DEFAULT '',
    color VARCHAR(7) DEFAULT '',
    slug VARCHAR(100) NOT NULL UNIQUE
);

-- Materials table
CREATE TABLE IF NOT EXISTS materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    image_url VARCHAR(500) DEFAULT '',
    icon VARCHAR(10) DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Likes junction table
CREATE TABLE IF NOT EXISTS material_likes (
    user_id INT NOT NULL,
    material_id INT NOT NULL,
    PRIMARY KEY (user_id, material_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE
);

-- FAQ table
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0
);

-- Team members table
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL,
    description TEXT,
    avatar_url VARCHAR(500),
    linkedin_url VARCHAR(255),
    twitter_url VARCHAR(255),
    github_url VARCHAR(255),
    sort_order INT DEFAULT 0
);
INSERT INTO categories (id, name, icon, color, slug) VALUES (5, 'Bounce объекты', '☁️', '#157BFF', 'bounce-objects');
INSERT INTO categories (id, name, icon, color, slug) VALUES (6, 'CTA Элементы', '📢', '#157BFF', 'cta-elements');
INSERT INTO categories (id, name, icon, color, slug) VALUES (7, 'Motion объекты', '✨', '#157BFF', 'motion-objects');
INSERT INTO categories (id, name, icon, color, slug) VALUES (8, 'Стрелки и линии', '🍭', '#157BFF', 'arrows-lines');
INSERT INTO categories (id, name, icon, color, slug) VALUES (9, 'Цифровые элементы', '🎞️', '#157BFF', 'digital-elements');
INSERT INTO categories (id, name, icon, color, slug) VALUES (10, 'Иконки платформ', '💡', '#157BFF', 'platform-icons');
INSERT INTO categories (id, name, icon, color, slug) VALUES (11, 'Неоновые иконки', '🖼️', '#157BFF', 'neon-icons');
INSERT INTO categories (id, name, icon, color, slug) VALUES (12, 'Наложения', '💬', '#157BFF', 'overlays');
INSERT INTO categories (id, name, icon, color, slug) VALUES (13, 'Пнг объекты', '✔️', '#157BFF', 'png-objects');
INSERT INTO categories (id, name, icon, color, slug) VALUES (14, 'Рамки для текстов', '📅', '#157BFF', 'text-frames');
INSERT INTO categories (id, name, icon, color, slug) VALUES (15, 'Переходы', '🔄', '#1877F2', 'transitions');
INSERT INTO categories (id, name, icon, color, slug) VALUES (16, 'Фоны', '🖼️', '#0056D2', 'backgrounds');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (401, 5, 'Айфон', '/static/materials/visual-elements/Bounce объекты/Айфон.mp4', '📦', '2026-05-30 10:19:59.621642');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (402, 6, '2D Подписка инстаграм 2', '/static/materials/visual-elements/CTA Элементы/2D Подписка инстаграм 2.mp4', '📦', '2026-05-30 10:19:59.643271');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (403, 6, '2D Подписка инстаграм', '/static/materials/visual-elements/CTA Элементы/2D Подписка инстаграм.mp4', '📦', '2026-05-30 10:19:59.658592');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (404, 6, '3D Подписка инстаграм', '/static/materials/visual-elements/CTA Элементы/3D Подписка инстаграм.mp4', '📦', '2026-05-30 10:19:59.672975');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (405, 6, 'Бардовая подписка 2', '/static/materials/visual-elements/CTA Элементы/Бардовая подписка 2.mp4', '📦', '2026-05-30 10:19:59.685614');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (406, 6, 'Бардовая подписка', '/static/materials/visual-elements/CTA Элементы/Бардовая подписка.mp4', '📦', '2026-05-30 10:19:59.698985');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (407, 6, 'Баунч инстаграм подписка 2', '/static/materials/visual-elements/CTA Элементы/Баунч инстаграм подписка 2.MP4', '📦', '2026-05-30 10:19:59.713017');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (408, 6, 'Баунч инстаграм подписка', '/static/materials/visual-elements/CTA Элементы/Баунч инстаграм подписка.mp4', '📦', '2026-05-30 10:19:59.725936');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (409, 6, 'Баунч подписка 2', '/static/materials/visual-elements/CTA Элементы/Баунч подписка 2.mp4', '📦', '2026-05-30 10:19:59.739176');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (410, 6, 'Баунч Подписка', '/static/materials/visual-elements/CTA Элементы/Баунч Подписка.mp4', '📦', '2026-05-30 10:19:59.752591');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (411, 6, 'Клик подписка', '/static/materials/visual-elements/CTA Элементы/Клик подписка.mp4', '📦', '2026-05-30 10:19:59.765194');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (412, 6, 'Минималистическая подписка', '/static/materials/visual-elements/CTA Элементы/Минималистическая подписка.mp4', '📦', '2026-05-30 10:19:59.777706');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (413, 6, 'Ораньжевая подписка 2', '/static/materials/visual-elements/CTA Элементы/Ораньжевая подписка 2.mp4', '📦', '2026-05-30 10:19:59.790495');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (414, 6, 'Ораньжевая подписка', '/static/materials/visual-elements/CTA Элементы/Ораньжевая подписка.mp4', '📦', '2026-05-30 10:19:59.804646');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (415, 6, 'Подписка тикток', '/static/materials/visual-elements/CTA Элементы/Подписка тикток.mp4', '📦', '2026-05-30 10:19:59.818891');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (416, 6, 'Подписка ютуб', '/static/materials/visual-elements/CTA Элементы/Подписка ютуб.mp4', '📦', '2026-05-30 10:19:59.832949');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (417, 6, 'Синяя подписка 2', '/static/materials/visual-elements/CTA Элементы/Синяя подписка 2.mp4', '📦', '2026-05-30 10:19:59.846460');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (418, 6, 'Синяя подписка', '/static/materials/visual-elements/CTA Элементы/Синяя подписка.mp4', '📦', '2026-05-30 10:19:59.861312');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (419, 7, 'Мозг', '/static/materials/visual-elements/Motion объекты/Мозг.mp4', '📦', '2026-05-30 10:19:59.884342');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (420, 7, 'Пачка денег', '/static/materials/visual-elements/Motion объекты/Пачка денег.mp4', '📦', '2026-05-30 10:19:59.909395');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (421, 8, 'Афтер эффектс 2', '/static/materials/visual-elements/Иконки платформ/Афтер эффектс 2.mp4', '📦', '2026-05-30 10:19:59.931644');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (422, 8, 'Афтер эффектс', '/static/materials/visual-elements/Иконки платформ/Афтер эффектс.MOV', '📦', '2026-05-30 10:19:59.943865');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (423, 8, 'Ватсап 2', '/static/materials/visual-elements/Иконки платформ/Ватсап 2.mp4', '📦', '2026-05-30 10:19:59.960149');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (424, 8, 'Ватсап', '/static/materials/visual-elements/Иконки платформ/Ватсап.mp4', '📦', '2026-05-30 10:19:59.973933');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (425, 8, 'Гугл 2', '/static/materials/visual-elements/Иконки платформ/Гугл 2.mp4', '📦', '2026-05-30 10:19:59.990242');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (426, 8, 'Гугл', '/static/materials/visual-elements/Иконки платформ/Гугл.mp4', '📦', '2026-05-30 10:20:00.005777');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (427, 8, 'Инстаграм 2', '/static/materials/visual-elements/Иконки платформ/Инстаграм 2.mp4', '📦', '2026-05-30 10:20:00.023299');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (428, 8, 'Инстаграм', '/static/materials/visual-elements/Иконки платформ/Инстаграм.mp4', '📦', '2026-05-30 10:20:00.038738');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (429, 8, 'Капкут', '/static/materials/visual-elements/Иконки платформ/Капкут.MOV', '📦', '2026-05-30 10:20:00.050338');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (430, 8, 'Премьер про 2', '/static/materials/visual-elements/Иконки платформ/Премьер про 2.mp4', '📦', '2026-05-30 10:20:00.064928');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (431, 8, 'Премьер про', '/static/materials/visual-elements/Иконки платформ/Премьер про.MOV', '📦', '2026-05-30 10:20:00.077763');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (432, 8, 'Телеграм', '/static/materials/visual-elements/Иконки платформ/Телеграм.mp4', '📦', '2026-05-30 10:20:00.092060');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (433, 8, 'Тикток 2', '/static/materials/visual-elements/Иконки платформ/Тикток 2.mp4', '📦', '2026-05-30 10:20:00.106118');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (434, 8, 'Тикток', '/static/materials/visual-elements/Иконки платформ/Тикток.mp4', '📦', '2026-05-30 10:20:00.119922');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (435, 8, 'Фейсбук', '/static/materials/visual-elements/Иконки платформ/Фейсбук.mp4', '📦', '2026-05-30 10:20:00.132953');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (436, 8, 'Чат гпт', '/static/materials/visual-elements/Иконки платформ/Чат гпт.mp4', '📦', '2026-05-30 10:20:00.147510');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (437, 8, 'Ютуб 2', '/static/materials/visual-elements/Иконки платформ/Ютуб 2.mp4', '📦', '2026-05-30 10:20:00.160795');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (438, 8, 'Ютуб', '/static/materials/visual-elements/Иконки платформ/Ютуб.mp4', '📦', '2026-05-30 10:20:00.174004');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (439, 9, 'Взрывы', '/static/materials/visual-elements/Наложения/Взрывы.mp4', '📦', '2026-05-30 10:20:00.203119');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (440, 9, 'Горизонтальные линии', '/static/materials/visual-elements/Наложения/Горизонтальные линии.PNG', '📦', '2026-05-30 10:20:00.217193');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (441, 9, 'Диагональные линии', '/static/materials/visual-elements/Наложения/Диагональные линии.PNG', '📦', '2026-05-30 10:20:00.231387');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (442, 9, 'Неправильно', '/static/materials/visual-elements/Наложения/Неправильно.MP4', '📦', '2026-05-30 10:20:00.251120');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (443, 9, 'Правильно', '/static/materials/visual-elements/Наложения/Правильно.MP4', '📦', '2026-05-30 10:20:00.266749');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (444, 9, 'Рамка записи камеры', '/static/materials/visual-elements/Наложения/Рамка записи камеры.mp4', '📦', '2026-05-30 10:20:00.285654');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (445, 9, 'Чёрный градиент', '/static/materials/visual-elements/Наложения/Чёрный градиент.PNG', '📦', '2026-05-30 10:20:00.297012');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (446, 10, 'Без Звука', '/static/materials/visual-elements/Неоновые иконки/Без Звука.mp4', '📦', '2026-05-30 10:20:00.320095');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (447, 10, 'Будильник', '/static/materials/visual-elements/Неоновые иконки/Будильник.mp4', '📦', '2026-05-30 10:20:00.341505');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (448, 10, 'Документ', '/static/materials/visual-elements/Неоновые иконки/Документ.mp4', '📦', '2026-05-30 10:20:00.358896');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (449, 10, 'Дом', '/static/materials/visual-elements/Неоновые иконки/Дом.mp4', '📦', '2026-05-30 10:20:00.378653');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (450, 10, 'Звук', '/static/materials/visual-elements/Неоновые иконки/Звук.mp4', '📦', '2026-05-30 10:20:00.395731');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (451, 10, 'Календарь', '/static/materials/visual-elements/Неоновые иконки/Календарь.mp4', '📦', '2026-05-30 10:20:00.414399');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (452, 10, 'Камера', '/static/materials/visual-elements/Неоновые иконки/Камера.mp4', '📦', '2026-05-30 10:20:00.430908');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (453, 10, 'Карта', '/static/materials/visual-elements/Неоновые иконки/Карта.mp4', '📦', '2026-05-30 10:20:00.448803');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (454, 10, 'Корзинка', '/static/materials/visual-elements/Неоновые иконки/Корзинка.mp4', '📦', '2026-05-30 10:20:00.466840');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (455, 10, 'Коробка', '/static/materials/visual-elements/Неоновые иконки/Коробка.mp4', '📦', '2026-05-30 10:20:00.485832');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (456, 10, 'Локация', '/static/materials/visual-elements/Неоновые иконки/Локация.mp4', '📦', '2026-05-30 10:20:00.503481');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (457, 10, 'Люди', '/static/materials/visual-elements/Неоновые иконки/Люди.mp4', '📦', '2026-05-30 10:20:00.520272');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (458, 10, 'Мир', '/static/materials/visual-elements/Неоновые иконки/Мир.mp4', '📦', '2026-05-30 10:20:00.540609');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (459, 10, 'Настройки', '/static/materials/visual-elements/Неоновые иконки/Настройки.mp4', '📦', '2026-05-30 10:20:00.563871');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (460, 10, 'Ноутбук', '/static/materials/visual-elements/Неоновые иконки/Ноутбук.mp4', '📦', '2026-05-30 10:20:00.582078');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (461, 10, 'Образование', '/static/materials/visual-elements/Неоновые иконки/Образование.mp4', '📦', '2026-05-30 10:20:00.602194');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (462, 10, 'Папка', '/static/materials/visual-elements/Неоновые иконки/Папка.mp4', '📦', '2026-05-30 10:20:00.622248');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (463, 10, 'Смартфон', '/static/materials/visual-elements/Неоновые иконки/Смартфон.mp4', '📦', '2026-05-30 10:20:00.644267');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (464, 10, 'Сообщение 2', '/static/materials/visual-elements/Неоновые иконки/Сообщение 2.mp4', '📦', '2026-05-30 10:20:00.661424');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (465, 10, 'Сообщение', '/static/materials/visual-elements/Неоновые иконки/Сообщение.mp4', '📦', '2026-05-30 10:20:00.678748');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (466, 10, 'Ссылка', '/static/materials/visual-elements/Неоновые иконки/Ссылка.mp4', '📦', '2026-05-30 10:20:00.699233');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (467, 10, 'Таблица', '/static/materials/visual-elements/Неоновые иконки/Таблица.mp4', '📦', '2026-05-30 10:20:00.716632');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (468, 10, 'Такси', '/static/materials/visual-elements/Неоновые иконки/Такси.mp4', '📦', '2026-05-30 10:20:00.734916');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (469, 10, 'Телефон', '/static/materials/visual-elements/Неоновые иконки/Телефон.mp4', '📦', '2026-05-30 10:20:00.753748');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (470, 10, 'Финиш', '/static/materials/visual-elements/Неоновые иконки/Финиш.mp4', '📦', '2026-05-30 10:20:00.772462');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (471, 10, 'Флаг Америки', '/static/materials/visual-elements/Неоновые иконки/Флаг Америки.mp4', '📦', '2026-05-30 10:20:00.793854');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (472, 11, 'Айфон на зелёном фоне', '/static/materials/visual-elements/Пнг объекты/Айфон на зелёном фоне.MP4', '📦', '2026-05-30 10:20:00.823699');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (473, 11, 'айфон пнг 1', '/static/materials/visual-elements/Пнг объекты/айфон пнг 1.PNG', '📦', '2026-05-30 10:20:00.835114');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (474, 11, 'айфон пнг 2', '/static/materials/visual-elements/Пнг объекты/айфон пнг 2.PNG', '📦', '2026-05-30 10:20:00.846577');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (475, 11, 'айфон пнг 3', '/static/materials/visual-elements/Пнг объекты/айфон пнг 3.PNG', '📦', '2026-05-30 10:20:00.856682');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (476, 11, 'Пнг ноутбук', '/static/materials/visual-elements/Пнг объекты/Пнг ноутбук.png', '📦', '2026-05-30 10:20:00.868730');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (477, 12, '0209(1)', '/static/materials/visual-elements/Рамки для текстов/0209(1).png', '📦', '2026-05-30 10:20:00.889209');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (478, 12, '0209(2)', '/static/materials/visual-elements/Рамки для текстов/0209(2).png', '📦', '2026-05-30 10:20:00.902136');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (479, 12, '0209(3)', '/static/materials/visual-elements/Рамки для текстов/0209(3).png', '📦', '2026-05-30 10:20:00.913627');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (480, 12, '0209', '/static/materials/visual-elements/Рамки для текстов/0209.png', '📦', '2026-05-30 10:20:00.925017');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (481, 12, 'select obj', '/static/materials/visual-elements/Рамки для текстов/select obj.mp4', '📦', '2026-05-30 10:20:00.940905');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (482, 12, 'бокс для текста @nmntzh (16)', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh (16).mp4', '📦', '2026-05-30 10:20:00.959520');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (483, 12, 'бокс для текста @nmntzh (18)', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh (18).mp4', '📦', '2026-05-30 10:20:00.977979');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (484, 12, 'бокс для текста @nmntzh (21)', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh (21).mp4', '📦', '2026-05-30 10:20:00.997675');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (485, 12, 'бокс для текста @nmntzh', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh.mp4', '📦', '2026-05-30 10:20:01.015519');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (486, 12, 'бокс для текста @nmntzh_1', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1.mp4', '📦', '2026-05-30 10:20:01.035988');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (487, 12, 'бокс для текста @nmntzh_14', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_14.mp4', '📦', '2026-05-30 10:20:01.056057');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (488, 12, 'бокс для текста @nmntzh_1_1', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_1.mp4', '📦', '2026-05-30 10:20:01.080705');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (489, 12, 'бокс для текста @nmntzh_1_2', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_2.mp4', '📦', '2026-05-30 10:20:01.107020');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (490, 12, 'бокс для текста @nmntzh_1_3', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_3.mp4', '📦', '2026-05-30 10:20:01.126041');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (491, 12, 'бокс для текста @nmntzh_1_4', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_4.mp4', '📦', '2026-05-30 10:20:01.144791');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (492, 12, 'бокс для текста @nmntzh_1_5', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_5.mp4', '📦', '2026-05-30 10:20:01.164647');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (493, 12, 'бокс для текста @nmntzh_1_6', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_1_6.mp4', '📦', '2026-05-30 10:20:01.183239');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (494, 12, 'бокс для текста @nmntzh_2', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_2.mp4', '📦', '2026-05-30 10:20:01.203203');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (495, 12, 'бокс для текста @nmntzh_4', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_4.mp4', '📦', '2026-05-30 10:20:01.221084');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (496, 12, 'бокс для текста @nmntzh_9', '/static/materials/visual-elements/Рамки для текстов/бокс для текста @nmntzh_9.mp4', '📦', '2026-05-30 10:20:01.235907');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (497, 12, 'подложка бардовая', '/static/materials/visual-elements/Рамки для текстов/подложка бардовая.mp4', '📦', '2026-05-30 10:20:01.251523');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (498, 12, 'подложка оранжевая', '/static/materials/visual-elements/Рамки для текстов/подложка оранжевая.mp4', '📦', '2026-05-30 10:20:01.267769');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (499, 12, 'подложка синяя', '/static/materials/visual-elements/Рамки для текстов/подложка синяя.mp4', '📦', '2026-05-30 10:20:01.282636');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (500, 12, 'подложка фиолетовая', '/static/materials/visual-elements/Рамки для текстов/подложка фиолетовая.mp4', '📦', '2026-05-30 10:20:01.297612');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (501, 12, 'подложка циановый', '/static/materials/visual-elements/Рамки для текстов/подложка циановый.mp4', '📦', '2026-05-30 10:20:01.313391');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (502, 13, 'Галочка', '/static/materials/visual-elements/Стрелки и линии/Галочка.mp4', '📦', '2026-05-30 10:20:01.333858');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (503, 13, 'Графика вверх', '/static/materials/visual-elements/Стрелки и линии/Графика вверх.mp4', '📦', '2026-05-30 10:20:01.350304');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (504, 13, 'Графика вниз', '/static/materials/visual-elements/Стрелки и линии/Графика вниз.mp4', '📦', '2026-05-30 10:20:01.369393');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (505, 13, 'Графика прогресса', '/static/materials/visual-elements/Стрелки и линии/Графика прогресса.mp4', '📦', '2026-05-30 10:20:01.385884');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (506, 13, 'закрученные стрелки', '/static/materials/visual-elements/Стрелки и линии/закрученные стрелки.mp4', '📦', '2026-05-30 10:20:01.405629');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (507, 13, 'Запрет', '/static/materials/visual-elements/Стрелки и линии/Запрет.mp4', '📦', '2026-05-30 10:20:01.422251');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (508, 13, 'Кнопка подробнее 1', '/static/materials/visual-elements/Стрелки и линии/Кнопка подробнее 1.mp4', '📦', '2026-05-30 10:20:01.447888');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (509, 13, 'Кнопка подробнее 2', '/static/materials/visual-elements/Стрелки и линии/Кнопка подробнее 2.mp4', '📦', '2026-05-30 10:20:01.473352');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (510, 13, 'линия карандаш', '/static/materials/visual-elements/Стрелки и линии/линия карандаш.mp4', '📦', '2026-05-30 10:20:01.500008');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (511, 13, 'Линия подчёркивания текста', '/static/materials/visual-elements/Стрелки и линии/Линия подчёркивания текста.mp4', '📦', '2026-05-30 10:20:01.522785');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (512, 13, 'обводка карандаш', '/static/materials/visual-elements/Стрелки и линии/обводка карандаш.mp4', '📦', '2026-05-30 10:20:01.552213');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (513, 13, 'Пульс', '/static/materials/visual-elements/Стрелки и линии/Пульс.mp4', '📦', '2026-05-30 10:20:01.574479');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (514, 13, 'Путь', '/static/materials/visual-elements/Стрелки и линии/Путь.mp4', '📦', '2026-05-30 10:20:01.599038');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (515, 13, 'Стрелка вверх', '/static/materials/visual-elements/Стрелки и линии/Стрелка вверх.mp4', '📦', '2026-05-30 10:20:01.624294');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (516, 13, 'Стрелка влево', '/static/materials/visual-elements/Стрелки и линии/Стрелка влево.mp4', '📦', '2026-05-30 10:20:01.644556');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (517, 13, 'Стрелка вниз', '/static/materials/visual-elements/Стрелки и линии/Стрелка вниз.mp4', '📦', '2026-05-30 10:20:01.667933');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (518, 13, 'Стрелка вправо', '/static/materials/visual-elements/Стрелки и линии/Стрелка вправо.mp4', '📦', '2026-05-30 10:20:01.687312');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (519, 13, 'стрелки карандаш', '/static/materials/visual-elements/Стрелки и линии/стрелки карандаш.mp4', '📦', '2026-05-30 10:20:01.707782');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (520, 13, 'узкая линия карандаш', '/static/materials/visual-elements/Стрелки и линии/узкая линия карандаш.mp4', '📦', '2026-05-30 10:20:01.729171');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (521, 13, 'Факторы', '/static/materials/visual-elements/Стрелки и линии/Факторы.mp4', '📦', '2026-05-30 10:20:01.747605');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (522, 14, '100k', '/static/materials/visual-elements/Цифровые элементы/100k.mp4', '📦', '2026-05-30 10:20:01.776858');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (523, 14, '200k', '/static/materials/visual-elements/Цифровые элементы/200k.mp4', '📦', '2026-05-30 10:20:01.800429');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (524, 14, '300k', '/static/materials/visual-elements/Цифровые элементы/300k.mp4', '📦', '2026-05-30 10:20:01.816858');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (525, 14, 'Цифра 1', '/static/materials/visual-elements/Цифровые элементы/Цифра 1.mp4', '📦', '2026-05-30 10:20:01.833074');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (526, 14, 'Цифра 10', '/static/materials/visual-elements/Цифровые элементы/Цифра 10.mp4', '📦', '2026-05-30 10:20:01.852047');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (527, 14, 'Цифра 10_', '/static/materials/visual-elements/Цифровые элементы/Цифра 10_.mp4', '📦', '2026-05-30 10:20:01.869481');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (528, 14, 'Цифра 1_', '/static/materials/visual-elements/Цифровые элементы/Цифра 1_.mp4', '📦', '2026-05-30 10:20:01.885684');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (529, 14, 'Цифра 2', '/static/materials/visual-elements/Цифровые элементы/Цифра 2.mp4', '📦', '2026-05-30 10:20:01.903083');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (530, 14, 'Цифра 2_', '/static/materials/visual-elements/Цифровые элементы/Цифра 2_.mp4', '📦', '2026-05-30 10:20:01.922340');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (531, 14, 'Цифра 3', '/static/materials/visual-elements/Цифровые элементы/Цифра 3.mp4', '📦', '2026-05-30 10:20:01.942145');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (532, 14, 'Цифра 3_', '/static/materials/visual-elements/Цифровые элементы/Цифра 3_.mp4', '📦', '2026-05-30 10:20:01.959289');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (533, 14, 'Цифра 4', '/static/materials/visual-elements/Цифровые элементы/Цифра 4.mp4', '📦', '2026-05-30 10:20:01.981963');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (534, 14, 'Цифра 4_', '/static/materials/visual-elements/Цифровые элементы/Цифра 4_.mp4', '📦', '2026-05-30 10:20:02.001953');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (535, 14, 'Цифра 5', '/static/materials/visual-elements/Цифровые элементы/Цифра 5.mp4', '📦', '2026-05-30 10:20:02.023773');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (536, 14, 'Цифра 5_', '/static/materials/visual-elements/Цифровые элементы/Цифра 5_.mp4', '📦', '2026-05-30 10:20:02.051838');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (537, 14, 'Цифра 6', '/static/materials/visual-elements/Цифровые элементы/Цифра 6.mp4', '📦', '2026-05-30 10:20:02.075071');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (538, 14, 'Цифра 6_', '/static/materials/visual-elements/Цифровые элементы/Цифра 6_.mp4', '📦', '2026-05-30 10:20:02.101409');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (539, 14, 'Цифра 7', '/static/materials/visual-elements/Цифровые элементы/Цифра 7.mp4', '📦', '2026-05-30 10:20:02.125622');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (540, 14, 'Цифра 7_', '/static/materials/visual-elements/Цифровые элементы/Цифра 7_.mp4', '📦', '2026-05-30 10:20:02.162131');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (541, 14, 'Цифра 8', '/static/materials/visual-elements/Цифровые элементы/Цифра 8.mp4', '📦', '2026-05-30 10:20:02.188007');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (542, 14, 'Цифра 8_', '/static/materials/visual-elements/Цифровые элементы/Цифра 8_.mp4', '📦', '2026-05-30 10:20:02.212293');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (543, 14, 'Цифра 9', '/static/materials/visual-elements/Цифровые элементы/Цифра 9.mp4', '📦', '2026-05-30 10:20:02.230399');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (544, 14, 'Цифра 9_', '/static/materials/visual-elements/Цифровые элементы/Цифра 9_.mp4', '📦', '2026-05-30 10:20:02.247355');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (545, 15, 'Transitions', '/static/materials/transitions/transitions.mp4', '', '2026-06-02 08:33:37.918672');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (546, 15, 'Transitions 1', '/static/materials/transitions/transitions_1.mp4', '', '2026-06-02 08:33:37.933925');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (547, 15, 'Transitions 2', '/static/materials/transitions/transitions_2.mp4', '', '2026-06-02 08:33:37.949476');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (548, 15, 'Transitions 3', '/static/materials/transitions/transitions_3.mp4', '', '2026-06-02 08:33:37.965031');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (549, 15, 'Transitions 4', '/static/materials/transitions/transitions_4.mp4', '', '2026-06-02 08:33:37.980191');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (550, 15, 'Transitions 5', '/static/materials/transitions/transitions_5.mp4', '', '2026-06-02 08:33:37.995042');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (551, 15, 'Transitions 6', '/static/materials/transitions/transitions_6.mp4', '', '2026-06-02 08:33:38.013329');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (552, 15, 'Transitions 7', '/static/materials/transitions/transitions_7.mp4', '', '2026-06-02 08:33:38.034790');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (553, 15, 'Transitions 8', '/static/materials/transitions/transitions_8.mp4', '', '2026-06-02 08:33:38.054719');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (554, 15, 'Reelslar 2', '/static/materials/transitions/Reelslar 2.mp4', '', '2026-06-02 08:33:38.073547');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (555, 15, 'Reelslar 2 1', '/static/materials/transitions/Reelslar 2_1.mp4', '', '2026-06-02 08:33:38.090333');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (556, 15, 'Reelslar 2 2', '/static/materials/transitions/Reelslar 2_2.mp4', '', '2026-06-02 08:33:38.109181');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (557, 15, 'Reelslar 2 3', '/static/materials/transitions/Reelslar 2_3.mp4', '', '2026-06-02 08:33:38.126146');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (558, 15, 'Reelslar 2 4', '/static/materials/transitions/Reelslar 2_4.mp4', '', '2026-06-02 08:33:38.143912');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (559, 15, 'Reelslar 2 5', '/static/materials/transitions/Reelslar 2_5.mp4', '', '2026-06-02 08:33:38.162462');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (560, 15, 'Reelslar 2 6', '/static/materials/transitions/Reelslar 2_6.mp4', '', '2026-06-02 08:33:38.180794');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (561, 15, 'Reelslar 2 7', '/static/materials/transitions/Reelslar 2_7.mp4', '', '2026-06-02 08:33:38.202888');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (562, 16, 'Comp 3', '/static/materials/backgrounds/Comp 3.mp4', '', '2026-06-02 08:44:54.728478');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (563, 16, 'Comp 3 1', '/static/materials/backgrounds/Comp 3_1.mp4', '', '2026-06-02 08:44:54.745608');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (564, 16, 'Comp 3 2', '/static/materials/backgrounds/Comp 3_2.mp4', '', '2026-06-02 08:44:54.763306');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (565, 16, 'Comp 3 3', '/static/materials/backgrounds/Comp 3_3.mp4', '', '2026-06-02 08:44:54.779518');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (566, 16, 'Comp 3 4', '/static/materials/backgrounds/Comp 3_4.mp4', '', '2026-06-02 08:44:54.796222');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (567, 16, 'Comp 3 5', '/static/materials/backgrounds/Comp 3_5.mp4', '', '2026-06-02 08:44:54.813327');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (568, 16, 'Comp 3 6', '/static/materials/backgrounds/Comp 3_6.mp4', '', '2026-06-02 08:44:54.829435');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (569, 16, 'Comp 3 7', '/static/materials/backgrounds/Comp 3_7.mp4', '', '2026-06-02 08:44:54.851945');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (570, 16, 'Comp 3 8', '/static/materials/backgrounds/Comp 3_8.mp4', '', '2026-06-02 08:44:54.868625');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (571, 16, 'Comp 3 9', '/static/materials/backgrounds/Comp 3_9.mp4', '', '2026-06-02 08:44:54.887559');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (572, 16, 'Comp 3 10', '/static/materials/backgrounds/Comp 3_10.mp4', '', '2026-06-02 08:44:54.913150');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (573, 16, 'Comp 3 11', '/static/materials/backgrounds/Comp 3_11.mp4', '', '2026-06-02 08:44:54.928542');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (574, 16, 'Comp 3 12', '/static/materials/backgrounds/Comp 3_12.mp4', '', '2026-06-02 08:44:54.945398');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (575, 16, 'Comp 3 13', '/static/materials/backgrounds/Comp 3_13.mp4', '', '2026-06-02 08:44:54.962720');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (576, 16, 'Серый Фон', '/static/materials/backgrounds/Серый фон.mp4', '', '2026-06-02 09:03:45.414857');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (577, 16, 'Зелёный Фон', '/static/materials/backgrounds/Зелёный фон.mp4', '', '2026-06-02 09:03:45.473081');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (578, 16, 'Розовый Фон', '/static/materials/backgrounds/Розовый фон.mp4', '', '2026-06-02 09:03:45.530419');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (579, 16, 'Красный Фон', '/static/materials/backgrounds/Красный фон.mp4', '', '2026-06-02 09:03:45.693688');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (580, 16, 'Бирюзовый Фон', '/static/materials/backgrounds/Бирюзовый фон.mp4', '', '2026-06-02 09:03:45.760427');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (581, 16, 'Фиолетовый Фон', '/static/materials/backgrounds/Фиолетовый фон.mp4', '', '2026-06-02 09:03:45.863929');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (582, 16, 'Белый Фон', '/static/materials/backgrounds/Белый фон.mp4', '', '2026-06-02 09:03:45.947392');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (583, 16, 'Жёлтый Фон', '/static/materials/backgrounds/Жёлтый фон.mp4', '', '2026-06-02 09:03:46.042941');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (584, 16, 'Синий Фон', '/static/materials/backgrounds/Синий фон.mp4', '', '2026-06-02 09:03:46.127584');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (585, 16, 'Коричневый Фон', '/static/materials/backgrounds/Коричневый фон.mp4', '', '2026-06-02 09:03:46.214730');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (586, 16, 'Тёмный Фон', '/static/materials/backgrounds/Тёмный фон.mp4', '', '2026-06-02 09:03:46.326630');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (587, 16, 'Зелёно Бело Серый Фон', '/static/materials/backgrounds/Зелёно-бело-серый фон.mp4', '', '2026-06-02 09:03:46.395629');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (588, 16, 'Коричнево Белый Фон', '/static/materials/backgrounds/Коричнево-белый фон.mp4', '', '2026-06-02 09:03:46.482918');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (589, 16, 'Небесно Голубой Фон', '/static/materials/backgrounds/Небесно-голубой фон.mp4', '', '2026-06-02 09:03:46.552964');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (590, 16, 'Фиолетово Белый Фон', '/static/materials/backgrounds/Фиолетово-белый фон.mp4', '', '2026-06-02 09:03:46.634531');
INSERT INTO materials (id, category_id, name, image_url, icon, created_at) VALUES (591, 16, 'Молочно Чёрно Коричневый Фон', '/static/materials/backgrounds/Молочно-чёрно-коричневый фон.mp4', '', '2026-06-02 09:03:46.705373');
