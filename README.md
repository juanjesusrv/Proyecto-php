Requisitos previos:

    -Importar la base de datos que se encuentra en la carpeta -> Base de datos
    -Descomprimir la carpetta y mantener todos los archivos en el mismo orden que están

Contenido de las carpetas:

    -Base de datos: Se encuentra el SQL
    -Diagramas: Aquí se encuentran todos los diagramas usados
    -Página: aquí se encuentra la página al completo, dentro de esta podemos encontrar:
        --Estilos: En esta se encuentrar los archivos css
        --imgs: En esta se encuentran todas las imagenes del proyecto
        --plantillas: En esta se pueden encontrar tanto el footer como el header
        --validaciones: Aquí se crean todos los archivos relevantes al funcionamiento del programa, como crear una reserva o crear un professor, también se encuentra dentro el PHPMailer
        --También se pueden encontrar los archivos principales que son los que le dan la forma a la página, como pueden ser:
            ---index.php: La página del loggin
            ---gestion_profesorado: La página a la que accede el vicedirector
            ---reserva: La página de reservas


Para empezar a usar el proyecto solo es necesario abrir el index.php con el navegador

El usuario principal para iniciar session es:

    username -> 11111111A
    password -> 1234 

El resto de usuarios son igual pero cambiando la 'A' en el username por otra letra hasta la 'I'.

Una vez en la página inicial, suponiendo que entres con el usuario princial, en caso contrario solo te saldrá la página reservas.
Podrás elegir entre la sección reservas o gestionar profesorado.

Resservas:
En reservas te saldrá  primeramente una opción para elegir la asignatura y el numero de alumnos con los que quieres hacer la reserva, cuando los seleccionas, puedes elegir el día, y por ultimo aparecerá otro recuadro en el que podrás seleccionar el tramo horario.
Justo debajo se encontrará una lista en la que puedes ver tus propias reservas y eliminarlas, o bien ver la de todos.

Gestión de profesorado:
A esta sección solo tendrá acceso el vicedirector, aquí tendrás un menú en el que puedes moverte y tienes las diferentes opciones, crear un profesor, eliminarlo, asignarle una asignatura, cambiar el vicedirector o ver la lista de todas las asignaturas que tienen asignado un profesor.



