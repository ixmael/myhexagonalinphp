# Arquitectura limpia
¿De qué se trata? En general, es una idea abstracta de cómo organizar el código. Acá está una referencia acerca de esto https://nescalro.medium.com/entendiendo-a-la-arquitectura-limpia-7877ad3a0a47.

De paso, usando esto usas los principios **SOLID**. En general, creo que es más tedioso, pero a la larga tienes mejor organizadas las reglas del negocio.

Esto es una implementación personal, sin tener que usar todos los elementos asociados (inyección de dependencias, CQRS, etc.) de forma automática que considero te hace perderte más. Sí terminas instanciando clases y las seteas manualmente, pero me gusta porque así vas entendiendo qué está pasando por debajo.

## Reglas de negocio
Lo importante (para mi) son las reglas de negocio. Lo que no me gusta del `MVC` es que en las mismas peticiones web está la petición, reglas de negocio, consultas a la base de datos y demás.

Las reglas son las mismas ya sea si tienes una aplicación web, una RestAPI o una aplicación de líneas de comando.

Las reglas de negocio las expresas en los servicios de tu `core`. En *src/Core* tienes todo lo asociado con el negocio: clases y servicios.

La implementación de los servicios del negocio se hace en *src/Core/Services* y en estas clases (que implementan una interfaz del negocio, *src/Core/Domain*) y en estas clases expresas las reglas de negocio.

## Servicios del `core`
Esto lo encuentras en la carpeta *src/Core/Services*. Lo que tienes aquí es una implementación de las interfaces que encuentras en el `core/domain`. El chiste de estas clases y métodos es poner todas las reglas de negocios. Por ejemplo:
- Existe un producto con ese ID
- Este producto se encuentra en el stock
- ¿Puedo surtir 5 (solicitados por el cliente) de este producto? o ¿el cliente pidió menos de los que tengo en stock?
- Si el usuario NO tiene una cuenta, no le permito continuar con la compra
- Si el usuario está baneado, no le permito continuar con la compra.
a estas reglas de negocio no les interesa si la información está en MySql, Mongo, un archivo CSV o lo que sea, tampoco les interesa si están con PHP, javascript o Cobol XD y menos si es una aplicación web, RestAPI, gRPC o una aplicación de línea de comando.

### Repositorios
Los repositorios son implementaciones para la base de datos. Estas implementaciones son de la o las interfaces que defines en *src/Core/Domain* y sólo son los métodos que quieres con la base de datos. Hice dos ejemplos, de MySQL y Mongo (no completos) y están en *src/Services/Repositories*.

### Servicios externos
Puedes definir los servicios que necesites. Por ejemplo, "hice" uno para una *API* de la **SEP** que con *curl* consultas eso. Otro para guardar documentos en la nube. Todo esto se expresan en reglas de negocio más abstractas:
- Guardar el certificado del usuario (subirlo a la nube o guardarlo en X directorio del servidor).
- Verificar si el certificado es válido (usar la API de la SEP).

## Web
La aplicación web son peticiones a través del internes. Acá, da lo mismo cómo las reglas del negocio son usadas: web, RestAPI o una aplicación de línea de comandos. Así que esto sólo es iniciar las peticiones, validar los datos web y después llamar al servicio requerido. Así que en *src/Apps/Web/Handlers* y en los handlers sólo sacas la información de la petición (id de la ruta, datos json del body, archivo) para pasarselo al servicio (o los servicios).

## RestAPI
La aplicación RestAPI es igual a la web sólo que responde con json. Las reglas de negocio siempre son las mismas. Así que en *src/Apps/RestAPI/Handlers* tienes los handlers que sólo responden jsons.
