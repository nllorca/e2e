# Farmacia CRUD
Resolución de challenge para proceso de selección de E2E por Nicolás Llorca.

## Compilación y Ejecución
El proyecto se realizó utilizando [Laravel Sail](https://laravel.com/docs/10.x/sail)

### Pre-requisitos
El único requisito de Sail es que Docker esté instalado en el sistema operativo en el que se va a ejecutar.
Si se utiliza Windows, se deberá que instalar y habilitar Windows Subsystem for Linux 2 (WSL2). Además, configurar Docker Desktop para utilizar el backend WSL2.

### Ejecución
Para ejecutar el proyecto se debe ejecutar:
```bash
./vendor/bin/sail up -d
```
De esta forma se crean los contenedores necesarios para ejecutar el proyecto. La descripción de los contenedores se encuentra disponible en [docker-compose.yml](./docker-compose.yml)

También es recomendable configurar un alias para ejecutar el comando más facilment.
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
y luego
```bash
sail up -d
```
_De ahora en más en dicho documento utilizaremos el alias del comando para los ejemplos_

## Test1
Se implementó sobre Laravel pero no se utilizaron herramientas del framework para su desarrollo para curbrir el proposito del ejercicio.
El código se encuentra en [app/Console/Commands/Test1.php](./app/Console/Commands/Test1.php)
Para su ejecución:
```bash
sail artisan app:test1
```

## Test2
Se incluye en el proyecto un archivo .SQL con las soluciones, en: [test2.sql[(./test2.sql)

## Test3
La API solicitada se desarrolló en Laravel. La documentación de la API, se implementó con [Scramble](https://scramble.dedoc.co/)
Para acceder a la documentación, se deberá ingresar por navegador a http://localhost/docs/api#/
