# Ejemplo Básico CRUD con AJAX
### Utilizando **PHP y Mysql**
## Tecnologías
Lista de tecnologías utilizadas en el proyecto:
* [Bootstrap](https://getbootstrap.com/): v4.6.2 
* [jQuery](https://jquery.com/): v3.6.4
* [SweetAlert2](https://sweetalert2.github.io/): v11.7.5
* [Select2](https://select2.org/): v4.1.0-rc.0
* [Font Awesome Free](https://fontawesome.com): v6.4.0
* [Inputmask](https://github.com/RobinHerbots/Inputmask): v5.0.9-beta.4
* [DataTables](https://datatables.net/): v1.11.4
* [DataTables Bootstrap 4 integration](https://datatables.net/manual/styling/bootstrap4)
* [DataTables Responsive](https://datatables.net/extensions/responsive/): v2.2.9
* [Bootstrap 4 integration for DataTables' Responsive](https://datatables.net/extensions/responsive/)
* [Buttons for DataTables](https://datatables.net/extensions/buttons/): v2.2.2
* [Bootstrap integration for DataTables' Buttons](https://datatables.net/extensions/buttons/): v2.2.2
* [HTML5 export buttons for Buttons and DataTables](https://datatables.net/)
* [Print button for Buttons and DataTables](https://datatables.net/)
* [Column visibility buttons for Buttons and DataTables](https://datatables.net/)
* [JSZip](http://stuartk.com/jszip): v3.7.1
* [pdfmake](http://pdfmake.org): v0.2.4
* [Pagination Library by CodexWorld](https://github.com/codexworld/Ajax-Pagination-in-PHP): v2.0
### Cambios Relevantes
23-05-2023
* Aplicada la Herencia de Clases en el model [Persona](model/Persona.php) 

21-05-2023:
* Incorporación de la clase de [Pagination](https://www.codexworld.com/pagination-with-jquery-ajax-php-mysql/)  
* Esta clase de paginación ayuda a integrar la paginación con Ajax en PHP.
* Modificaciones leves a [Pagination](resources/php-pagination/Pagination.php) para usarla junto con [DataTables](https://datatables.net/)
* La paginación fallará si no está vinculado el archivo [datatable-app.js](js/datatable-app.js)
* Creación de la función [paginate()](funciones/paginate.php)
* Agregado al [Model](model/Model.php) la opción de paginar registros.
* Para traer con Ajax los registros de la paginación usamos [getData.php](getData.php)

20-05-2023:
* Estructura interna de los [Model](model/Model.php) optimizada.
* Incorporación de la libreria de [DataTables](https://datatables.net/)
* Manejo de Excepciones al procesar los datos (TRY CATCH) ver [procesar2.php](procesar2.php)
* [app.js](js/app.js) optimizado para el uso de [DataTables](https://datatables.net/)