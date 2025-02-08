# **EduReserva**

Proyecto final de PHP: Este programa gestionará el sistema de reservas del salón de actos en un instituto.

## **Usuarios del sistema**
- **Profesores**:  
  Los profesores podrán:
  - Ver los tramos libres en los que pueden reservar.
  - Consultar un listado con sus reservas.
  - Cancelar o mover sus reservas.

- **Vicedirector**:  
  El vicedirector podrá:
  - Realizar todas las acciones disponibles para los profesores.
  - Añadir nuevos profesores al sistema.
  - Eliminar profesores (también se eliminarán sus reservas asociadas).
  - Ver todas las reservas realizadas en el sistema.

## **Tecnologías a implementar**
- **PHP**: Lenguaje principal para la lógica del servidor.
- **MySQL**: Gestión de la base de datos.
- **HTML**: Estructura del frontend.
- **CSS**: Estilo y diseño visual del sistema.
- **JavaScript**: Interactividad y validaciones en el cliente.

---

## **Clases del sistema**

### **Salón de Actos**
- Restricciones:
  - Máximo de **3 grupos** simultáneos o un máximo de **100 alumnos** en el salón.

### **Profesores**
Los profesores tendrán las siguientes funcionalidades:
- Iniciar sesión en el sistema.
- Reservar tramos libres disponibles.
- Listar y consultar sus reservas activas.
- Anular o modificar sus propias reservas.

### **Vicedirector**
El vicedirector contará con las siguientes funcionalidades:
- Crear nuevos usuarios tipo "Profesor".
- Eliminar usuarios tipo "Profesor" (incluyendo la eliminación de sus reservas).
- Ver todas las reservas realizadas en el sistema, con filtros por fecha, profesor o actividad.
- Todas las funcionalidades disponibles para los profesores.

---

## **Diagramas a desarrollar**
Para una mejor comprensión y diseño del proyecto, se desarrollarán los siguientes diagramas:
1. **Modelo Entidad-Relación (ERD)**: Representará las entidades principales y sus relaciones.
2. **Modelo Relacional**: Esquema lógico de la base de datos en MySQL.
3. **Diagrama de Flujo**: Mostrará el flujo de trabajo desde el inicio de sesión hasta la gestión de reservas.
4. **Diagrama de Clases UML**: Representará las clases principales del sistema y sus métodos asociados.
5. **Diagrama de Casos de Uso**: Identificará los actores (Profesor y Vicedirector) y sus interacciones con el sistema.

---

## **Miembros del equipo**
El desarrollo del proyecto estará a cargo de:
- Juan Jesús Rivillas
- Rubén Torrico
- Pablo Robles
- Daniel Godoy
- Rafael Jiménez
