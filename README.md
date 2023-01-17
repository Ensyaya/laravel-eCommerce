# eCommerce

Laravel , jQuery ve Tailwind CSS ile yazılmış full-stack bir e-ticaret sistemi.

## Tech Stack
**Backend**: [Laravel](https://laravel.com/)

**Frontend** [Blade Template](https://laravel.com/docs/9.x/blade#main-content), JQuery, Tailwind CSS

**Database** MySQL, [Eloquent ORM](https://laravel.com/docs/9.x/eloquent), [Query Builder](https://laravel.com/docs/9.x/queries#main-content)

## Features
| Feature | Technology |
| ----------- | ----------- |
| Authentication | [laravel/breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze) |
| Filtreleme | [Laravel](https://laravel.com/docs/9.x/eloquent-relationships#inline-relationship-existence-queries) |
| Pagination | [Laravel](https://laravel.com/docs/9.x/eloquent-resources#pagination) |
| Comment/Subcomment | [JQuery](https://jquery.com/)/[Laravel](https://laravel.com) |
| Sipariş durumu |   [Laravel](https://laravel.com/)    |
| Ürün değerlendirme | [Laravel](https://laravel.com/)    |
| Alert/Notification |[Sweetalert2](https://sweetalert2.github.io/#examples) |
| Fotoğraf yükleme | [cloudinary](https://cloudinary.com/)  |
| Style | [Tailwind CSS](https://tailwindcss.com/)
## Examples
![image](https://user-images.githubusercontent.com/99960369/212980045-a7f2fbc3-08d5-44bb-95f6-e98553e4b6d6.png)
![image](https://user-images.githubusercontent.com/99960369/212980046-edbf23ce-04a3-4490-ba71-593213c93dec.png)
### user
![image](https://user-images.githubusercontent.com/99960369/212980053-6803ebd7-a712-445f-b4d5-b24c9a4d505c.png)
![image](https://user-images.githubusercontent.com/99960369/212980056-d96e6a4a-ac13-44cc-bbdb-6b6538daf807.png)
### admin
![image](https://user-images.githubusercontent.com/99960369/212980066-3761e7ee-61eb-42a9-a974-83a1e107d306.png)
![image](https://user-images.githubusercontent.com/99960369/212980040-73272bd7-c3b0-4449-b99b-f7934fddb370.png)
### user
![image](https://user-images.githubusercontent.com/99960369/212980050-1073c76e-93d4-4042-a4b0-9c7cf02c5677.png)
### admin
![image](https://user-images.githubusercontent.com/99960369/212980061-71ebdbc2-b516-4d30-b032-49238b2ed5db.png)
### admin
![image](https://user-images.githubusercontent.com/99960369/212980067-0a4a098a-7da8-4928-8438-c0bfa374e663.png)
![image](https://user-images.githubusercontent.com/99960369/212980036-bb55a8d2-1f2f-47ba-baa7-092ab1858693.png)
![image](https://user-images.githubusercontent.com/99960369/212980043-17299c5c-dac1-471e-ba86-962a64edfe67.png)
![image](https://user-images.githubusercontent.com/99960369/212980059-dab6faeb-7c32-452f-8636-27814820a9d5.png)


1. Install PHP dependencies 
    ```sh
    composer install
    ```

2. install front-end dependencies
    ```sh
    npm install
    ```

3. Run migration
    ```
    php artisan migrate:fresh --seed
    ```
    this command will create 1 users (admin):
     > email: admin@admin.com , password: password

4. Run server 
   
    ```sh
    php artisan serve
    ```  
