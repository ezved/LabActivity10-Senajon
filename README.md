# Barangay Bulletin – Purok Senajon

Lab Activity 10 (4-334 Full-Stack Web Development): Eloquent, migrations and seeding.
A small blog for Barangay Matina Crossing Hall, Davao City, where officials post announcements and residents can browse, search and page through them.

## My personalized details

- **Site title:** Barangay Bulletin – Purok Senajon
- **Posts per page:** 7. My last name, Senajon, has 7 letters, so `paginate(7)`.
- **Custom category:** Sports & Youth (the others are Announcement, Health, Peace & Order, Ayuda)
- **Kagawad author:** Kagawad Lourrence Ed Senajon (`kagawad.senajon@bulletin.test`), made by hand with `Author::create()`
- **Pinned post:** "Purok Senajon Clean-up Drive", published on **October 15, 2026** (my birthday)

## What is in it

- Migrations for `authors` and `posts`, plus a separate `add_views_to_posts_table` migration (each with `down()`)
- `Author` and `Post` models with `$fillable` and casts
- Factories (`PostFactory` has a `draft()` state) and seeders: 5 authors, 51 posts (40 published, 10 drafts, 1 pinned)
- `/posts` lists published posts, pinned first, then newest, with `?q=` title search and `?category=` filter, 7 per page
- `/posts/{id}` shows one post (404 for missing or draft posts) and adds 1 to `views`
- Proof of ActiveRecord in tinker: `docs/tinker.png`

## How to run

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

Then open http://127.0.0.1:8000. If `database/database.sqlite` is missing, create it first (PowerShell: `New-Item database/database.sqlite`).
