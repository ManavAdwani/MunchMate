# MunchMate 🍔

> A delightful, full-stack food delivery platform tailored for seamless interactions between Customers, Restaurants, and Delivery Partners.

![Banner](https://i.ibb.co/1h9HcQD/screencapture-localhost-8000-2025-12-29-15-15-34.png)

## 📖 About

**MunchMate** is an online food delivery ecosystem built to simulate real-world food ordering operations. The platform is divided into three distinct panels, each with specialized workflows:
- **User Panel**: For browsing menus, customizing orders, and making payments.
- **Restaurant Panel**: For managing menus, tracking incoming orders, and updating restaurant details.
- **Delivery Panel**: For delivery partners to accept jobs and update delivery status order tracking.

Built with **Laravel 10** and **MySQL**, MunchMate demonstrates robust backend logic combined with a responsive, user-friendly frontend.

---

## ✨ Features

### 🧑‍🍳 For Customers
- **Restaurant Discovery**: Browse a variety of restaurants and view their profiles.
- **Dynamic Menus**: View detailed menus with images and prices.
- **Cart & Checkout**: Seamlessly add items to cart and checkout with integrated payment (Stripe).
- **Order Tracking**: Real-time status updates on active orders.
- **Responsive Design**: Optimized for both desktop and mobile devices.

### 🏪 For Restaurants
- **Dashboard**: Overview of restaurant performance.
- **Menu Management**: Add, edit, or remove menu items dynamically.
- **Order Management**: Accept internal orders and prepare them for delivery.
- **Location Updates**: Update restaurant availability and location.

### 🚚 For Delivery Partners
- **Job Board**: View available delivery requests which are under 20km from his location.
- **Status Updates**: Mark orders as 'Picked Up' or 'Delivered'.
- **Registration**: Dedicated signup flow for new delivery partners.

---

## 🛠 Tech Stack

**Backend**
- **Framework**: Laravel 10.x
- **Database**: MySQL
- **Payment Processing**: Stripe API

**Frontend**
- **Core**: HTML5, CSS3, JavaScript
- **Styling**: Bootstrap 5, Custom CSS
- **Bundler**: Vite

**Tools & Services**
- **Composer**: Dependency Management
- **Git**: Version Control

---

## 🚀 Installation & Setup

Follow these steps to set up the project locally.

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/ManavAdwani/MunchMate.git
   cd MunchMate
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   *Open the `.env` file and configure your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).*

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Serve the Application**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://localhost:8000`.

---

## 🔐 Credentials (Demo)

Use these credentials to test the different user roles.

| Role | Phone | Password |
| :--- | :--- | :--- |
| **User** | `501020291` | `12345` |
| **Restaurant** | `123456789` | `12345` |
| **Delivery** | `909899999` | `12345` |

---

## 📂 Project Structure

- `app/Models` - Eloquent models (User, Restaurant, Order, etc.)
- `app/Http/Controllers` - Application logic handling requests.
- `resources/views` - Blade templates for the UI.
- `routes/web.php` - Web route definitions.
- `database/migrations` - Database schema definitions.

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---

## 👤 Author

**Manav Adwani**
- Github: [@ManavAdwani](https://github.com/ManavAdwani)
- Portfolio: [katherineoelsner.com](https://katherineoelsner.com/)
- LinkedIn: [LinkedIn](https://www.linkedin.com/)

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
