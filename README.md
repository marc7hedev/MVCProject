---

# 📋 Proyecto CRUD con PHP (MVC)

¡Bienvenido a mi proyecto CRUD hecho con PHP puro! Este proyecto utiliza el modelo vista controlador (MVC) y está diseñado para proporcionar un sistema de gestión de datos robusto y seguro.

## 🚀 Características

- **Modelo Vista Controlador (MVC)**: Arquitectura organizada para separar la lógica del negocio, la presentación y la gestión de datos.
- **Conexiones a MySQL**: Gestión eficiente de las bases de datos utilizando MySQL.
- **Seguridad Mejorada**: Protección contra inyecciones SQL y otras vulnerabilidades de seguridad.
- **Autenticación Segura**: Sistema de inicio de sesión seguro.
- **Filtrado y Limpieza de Datos**: Validación y limpieza de datos antes de insertarlos en la base de datos.
- **Front End Limpio y Sencillo**: Diseño atractivo y minimalista utilizando la librería Bulma.
- **Interfaces y Dashboards**: Interfaz de usuario intuitiva y fácil de usar para gestionar datos.

## 🛠️ Instalación

1. **Clonar el repositorio**:

   ```sh
   git clone https://github.com/marc7hedev/minimalPortfolio.git
   cd tu-repositorio
   ```

2. **Configuración de la base de datos**:
   - Crea una base de datos en MySQL.
   - Importa el archivo `database.sql` incluido en el repositorio.
   - Configura las credenciales de la base de datos en el archivo `config/database.php`.

3. **Instalar dependencias**:
   - Asegúrate de tener Composer instalado.
   ```sh
   composer install
   ```

4. **Configuración del servidor web**:
   - Configura tu servidor web (Apache, Nginx, etc.) para apuntar al directorio del proyecto.
   - Asegúrate de que el servidor tenga habilitado PHP.

## 🖥️ Uso

1. **Iniciar el servidor**:

   ```sh
   php -S localhost:8000
   ```

2. **Abrir en el navegador**:
   - Abre `http://localhost:8000` en tu navegador para ver la aplicación en funcionamiento.

## 📂 Estructura del Proyecto

```plaintext
/
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── core/
├── public/
│   ├── css/
│   ├── js/
│   └── index.php
├── config/
│   └── database.php
├── database/
│   └── database.sql
├── composer.json
└── README.md
```

## 🛡️ Seguridad

- **Protección contra inyección SQL**: Todas las consultas a la base de datos se realizan utilizando declaraciones preparadas.
- **Autenticación segura**: Implementación de un sistema de inicio de sesión seguro con manejo de sesiones.
- **Validación y limpieza de datos**: Filtros de entrada y salida para asegurar que los datos sean válidos y seguros.

## 🎨 Estilo y Diseño

- **Librería Bulma**: Utiliza la librería Bulma para un diseño moderno y responsive.
- **Interfaz de Usuario**: Interfaz limpia y sencilla, fácil de usar y navegar.

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Por favor, sigue estos pasos:

1. Haz un fork del proyecto.
2. Crea una rama nueva (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commits (`git commit -m 'Agregar nueva funcionalidad'`).
4. Envía tus cambios (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT. Para más información, consulta el archivo [LICENSE](LICENSE).

## 📞 Contacto

Si tienes alguna pregunta o sugerencia, no dudes en contactarme a través de [contacto@marco-rangel.tech](mailto:contacto@marco-rangel.tech).

---

¡Gracias por visitar mi proyecto! 😊

---
