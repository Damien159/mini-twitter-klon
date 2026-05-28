# 🐦 Mini Twitter Clone

A full-stack social media web application built with Laravel, Livewire, and Tailwind CSS.
Users can create posts, like content, view public profiles, and discover trending content — all without page reloads.

> Built as part of my apprenticeship as an Application Developer at ibis acam Bildungs GmbH.

---

## 🚀 Live Demo

> 🔗 [Coming soon — deploying on Railway]

---

## 📸 Screenshots
<img width="506" height="523" alt="image" src="https://github.com/user-attachments/assets/8f56097a-c404-4555-9d2e-3937dcc8a804" />
<img width="1841" height="940" alt="image" src="https://github.com/user-attachments/assets/b3a4dae0-c667-4906-b39f-3796aab0bf1d" />
<img width="1800" height="941" alt="image" src="https://github.com/user-attachments/assets/c2e6377b-7ea6-4f35-967b-956dd9074f59" />
<img width="1862" height="558" alt="image" src="https://github.com/user-attachments/assets/6d3ccaa1-836e-4c9d-a089-0d0575ad7d9c" />
<img width="1150" height="606" alt="image" src="https://github.com/user-attachments/assets/4b9d6541-1fde-4112-9f6b-d1d7deec0cd8" />


---

## 🛠️ Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## ✨ Features

- 📝 **Create & delete posts** — Write posts with a title and body via a modal dialog
- ❤️ **Like / Unlike** — Toggle likes on any post; heart icon turns red when liked
- 👤 **Public profile pages** — View any user's posts, total likes received, and post count
- 🔥 **Trending feed** — Sort posts by "Latest" or "Most Liked"
- ⚡ **Real-time updates** — Feed auto-refreshes every 5 seconds via Livewire polling (no page reload)
- 📄 **Pagination** — 5 posts per page with smooth navigation
- 🔒 **Authentication** — Register, login and protected routes out of the box

---

## ⚙️ Installation & Setup

### Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL database

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/Damien159/mini-twitter-klon.git
cd mini-twitter-klon

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Copy environment file and configure your database
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Run database migrations
php artisan migrate

# 7. Build frontend assets
npm run build

# 8. Start the development server
php artisan serve
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

---

## 🗄️ Database Structure

| Table   | Key Fields                                      |
|---------|-------------------------------------------------|
| `users` | id, name, email, password                       |
| `posts` | id, user_id, title, body, timestamps            |
| `likes` | id, user_id, post_id, timestamps (unique pair)  |

**Relationships:**
- A user has many posts
- A post has many likes
- A user can like a post only once (enforced via unique constraint)

---

## 📁 Project Structure

```
app/
├── Livewire/
│   ├── DiscoverContent.php   # Main feed: create, filter, like posts
│   └── UserProfile.php       # Public profile with post & like stats
resources/
└── views/
    └── livewire/
        ├── discover-content.blade.php
        └── user-profile.blade.php
```

---

## 🧠 Technical Highlights

- **Eager Loading** on all database queries to prevent N+1 performance issues
- **Livewire polling** (`wire:poll.5s`) for real-time feed updates without WebSockets
- **Toggle like logic** — single method handles both like and unlike
- **Flux UI components** used throughout for consistent, accessible UI

---

## 👤 Author

**Damien Blaumüller**
- 🌐 [damienblaumueller.at](https://damienblaumueller.at)
- 💼 [LinkedIn](https://www.linkedin.com/in/damien-blaumüller-07b9423bb/)
- 🐙 [GitHub](https://github.com/Damien159)
