# 🚀 Filament Learn

A modern **Laravel + Filament admin panel project** built for learning and implementing real-world features like products, categories  media handling, and more.

---

## 📌 About the Project

This project is a hands-on learning implementation of **Filament Admin Panel** with:

* 🧾 Product management
* 🗂️ Category system
* 👤 User roles & permissions (Spatie)
* 🖼️ Image upload & auto cleanup
* ✍️ Rich text editor (blog/content)
* 🧭 Multi-step forms (Wizard)
* ♻️ Soft delete & restore system

---

## ⚙️ Tech Stack

* **Laravel 12**
* **Filament Admin Panel**
* **Livewire**
* **Tailwind CSS**


---

## 📁 Features

### 🛍️ Product Management

* Create, edit, delete products
* Image upload with auto delete (old + unused)
* Price formatting (₹ currency)
* Slug generation

### 🗂️ Category Management

* CRUD operations
* Relationship with products

### ✍️ Rich Editor

* Content creation with image upload
* Auto cleanup of unused images
* Plain text preview support

### 🧭 Wizard Form

* Multi-step product form
* Validation per step
* Better UX

### 👤 Authentication & Roles

* User & Admin separation
* Role-based access control

### ♻️ Soft Delete System

* Trash system
* Restore option
* Force delete removes images

---

## 🛠️ Installation

```bash
git clone https://github.com/webcodingravi/filament_admin_learn.git

cd filament-learn

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm install
npm run build

php artisan storage:link   # IMPORTANT

php artisan serve
```

---

## ⚠️ Important Notes

* Run `php artisan storage:link` to access uploaded images
* Images are stored in:

  ```
  storage/app/public/
  ```
* Public access path:

  ```
  public/storage/
  ```

---

## 🧠 Key Learnings

* Filament resource structure
* Form & table customization
* File handling in Laravel
* Soft delete vs force delete
* Livewire reactivity issues & fixes

---



## 🤝 Contributing

Feel free to fork this repo and improve it.

---

## 📄 License

This project is open-source and available under the MIT License.

---

## 👨‍💻 Author

**Ravi Kumar**

---

## ⭐ Support

If you like this project, give it a ⭐ on GitHub!

---
