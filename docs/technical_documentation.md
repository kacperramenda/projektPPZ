# 🛠️ Dokumentacja Techniczna – Aplikacja Laravel User Manager

## 📚 Spis Treści

1. [Technologie](#technologie)
2. [Struktura Projektu](#struktura-projektu)
3. [Instalacja i Konfiguracja](#instalacja-i-konfiguracja)
4. [Baza Danych](#baza-danych)
5. [Uruchamianie Środowiska Developerskiego](#uruchamianie-środowiska-developerskiego)
6. [Testowanie](#testowanie)
7. [Uprawnienia i Role (Spatie)](#uprawnienia-i-role-spatie)
8. [Routing](#routing)
9. [Widoki i Inertia.js](#widoki-i-inertiajs)
10. [Najczęstsze Problemy i Rozwiązania](#najczęstsze-problemy-i-rozwiązania)

---

## ⚙️ Technologie

- **Laravel 10**
- **PHP 8.2+**
- **MySQL 8**
- **Laravel Sail (Docker)**
- **Inertia.js + Vue.js**
- **Spatie Laravel Permission**
- **PHPUnit**

---

## 📁 Struktura Projektu

```
projektPPZ/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Admin/        # Kontrolery panelu administratora
│           └── User/         # Kontrolery panelu użytkownika
├── resources/
│   └── js/
│       └── Pages/            # Komponenty Inertia (Vue)
├── routes/
│   ├── web.php               # Ładowanie tras
│   ├── user.php              # Trasy użytkownika
│   └── admin.php             # Trasy administratora
├── database/
│   ├── migrations/           # Migracje DB
│   └── seeders/              # Seeder ról/użytkowników
├── tests/
│   └── Feature/User/         # Testy funkcjonalne użytkownika
└── .env                      # Zmienna środowiskowa
```

---

## 🔧 Instalacja i Konfiguracja

1. Sklonuj repozytorium:
   ```bash
   git clone https://adres-do-repo.git
   cd projektPPZ
   ```

2. Zainstaluj zależności:
   ```bash
   composer install
   ```

3. Skonfiguruj środowisko:
   ```bash
   cp .env.example .env
   ./vendor/bin/sail artisan key:generate
   ```

4. Uruchom kontenery Docker:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. Uruchom migracje i seedy:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

6. (Opcjonalnie) uruchom frontend:
   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```

---

## 🗄️ Baza Danych

Główna tabela `users` zawiera:

| Pole              | Typ            | Opis                        |
|-------------------|----------------|-----------------------------|
| `name`            | varchar(255)   | Imię użytkownika            |
| `surname`         | varchar(255)   | Nazwisko użytkownika        |
| `description`     | varchar(255)   | Opis użytkownika (bio)      |
| `email`           | varchar(255)   | Unikalny adres email        |
| `password`        | varchar(255)   | Hasło zaszyfrowane          |
| `email_verified_at`| timestamp     | Data weryfikacji emaila     |

Uprawnienia i role obsługiwane są przez Spatie:

- `roles`
- `permissions`
- `model_has_roles`
- `model_has_permissions`
- `role_has_permissions`

---

## ▶️ Uruchamianie Środowiska Developerskiego

```bash
./vendor/bin/sail up -d
```

Frontend (opcjonalnie):

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Domyślny adres: `http://localhost`

---

## 🧪 Testowanie

1. Migracja testowej bazy danych:
   ```bash
   ./vendor/bin/sail artisan migrate:fresh --env=testing
   ```

2. Uruchomienie testów:
   ```bash
   ./vendor/bin/sail test
   ```

3. Filtrowanie testów:
   ```bash
   ./vendor/bin/sail test --filter=PanelTest
   ```

---

## 🔐 Uprawnienia i Role (Spatie)

**Tworzenie ról:**
```php
use Spatie\Permission\Models\Role;
Role::create(['name' => 'admin']);
```

**Przypisanie roli użytkownikowi:**
```php
$user->assignRole('admin');
```

**Sprawdzanie roli:**
```php
$user->hasRole('admin');
```

---

## 🌐 Routing

### `routes/user.php`
```php
Route::get('/user/panel', function () {
    return Inertia::render('User/Index', [
        'user' => auth()->user(),
    ]);
})->middleware('auth');
```

### `routes/admin.php`
```php
Route::get('/admin/users', [UserController::class, 'index'])->middleware('role:admin');
```

### `routes/web.php`
```php
require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
```

---

## 🎨 Widoki i Inertia.js

Widoki frontendowe zbudowane są przy użyciu Vue i ładowane przez Inertia.js.

### Przykład komponentu:

**Kontroler:**
```php
return Inertia::render('User/Index', ['user' => $user]);
```

**Widok (Vue):** `resources/js/Pages/User/Index.vue`

Dane przekazywane z kontrolera są dostępne jako propsy w komponencie.

---

## 🧠 Najczęstsze Problemy i Rozwiązania

### ❓ Test `assertSeeText` nie przechodzi

- Upewnij się, że testowany widok rzeczywiście zawiera `Jan Kowalski`
- Możesz to zmienić np. na:
  ```php
  $response->assertSeeText($user->name);
  ```

### ❓ Nie ma widoku `panel.blade.php`

- Używana jest Inertia i Vue, więc widoki są w `resources/js/Pages/`, nie w `views/`.

### ❓ Testy nie działają z bazą danych

- Upewnij się, że masz `DB_CONNECTION` ustawione w `phpunit.xml` lub `.env.testing`
- Przykład ustawień:
  ```xml
  <env name="DB_CONNECTION" value="mysql"/>
  <env name="DB_DATABASE" value="testing"/>
  <env name="DB_USERNAME" value="sail"/>
  <env name="DB_PASSWORD" value="password"/>
  ```

---
