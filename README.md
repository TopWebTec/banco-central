# Sistema Bancario Distribuido - Core (Banco Central)

Este repositorio contiene el núcleo central del Sistema Bancario. Se encarga de la gestión global de sucursales, cajeros automáticos, autenticación de nodos (mediante API Keys) y auditoría inmutable de transacciones.

## 🏛 Diagrama de Arquitectura del Sistema

El sistema sigue una arquitectura distribuida donde los nodos (Sucursales y Cajeros) operan de manera independiente, pero sincronizan el saldo global y transacciones de manera atómica con el núcleo central.

```mermaid
graph TD
    subgraph "Base de Datos Central"
        DB[(Supabase / PostgreSQL)]
    end

    subgraph "Nodo 1: Banco Central (Laravel)"
        Admin[Panel Administrativo]
        API_Core[API Rest (Core)]
    end

    subgraph "Nodo 2: Sucursal (Web)"
        Sucursal[App Sucursal]
    end

    subgraph "Nodo 3: Cajero Automático"
        ATM[Simulador ATM]
    end

    Admin -->|Gestión de Nodos & Reportes| DB
    API_Core -->|Transacciones Atómicas RPC| DB

    Sucursal -->|POST /api/v1/accounts/register| API_Core
    ATM -->|POST /api/v1/atm/withdraw| API_Core

    %% Autenticación
    Sucursal -.->|X-API-Key| API_Core
    ATM -.->|X-API-Key| API_Core
```

## 🚀 Enlaces de Despliegue

A continuación se encuentran los enlaces a los entornos de producción de cada uno de los nodos del sistema:

*   **Banco Central (Core):** [Enlace de despliegue en Render/Coolify] <!-- Reemplaza aquí -->
*   **Nodo Sucursal:** [Enlace de despliegue en Coolify/Vercel] <!-- Reemplaza aquí -->
*   **Nodo Cajero Automático (ATM):** [Enlace de despliegue en Vercel] <!-- Reemplaza aquí -->

## 📚 Especificación OpenAPI (Swagger)

Esta es la especificación técnica de la API para la comunicación entre el Banco Central y los nodos.

```yaml
openapi: 3.0.0
info:
  title: API Banco Central
  version: 1.0.0
  description: API de comunicación para nodos del sistema bancario (Sucursales y Cajeros).
servers:
  - url: 'https://tu-dominio-banco-central.com/api/v1'
    description: Servidor de Producción
components:
  securitySchemes:
    ApiKeyAuth:
      type: apiKey
      in: header
      name: X-API-Key
security:
  - ApiKeyAuth: []
paths:
  /accounts/register:
    post:
      summary: Apertura de cuenta bancaria
      description: Registra una nueva cuenta con saldo inicial. Exclusivo para nodos tipo "sucursal".
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                account_number:
                  type: string
                holder_name:
                  type: string
                initial_balance:
                  type: number
      responses:
        '200':
          description: Cuenta creada y depósito inicial registrado exitosamente.
        '403':
          description: Nodo no autorizado.
  /atm/withdraw:
    post:
      summary: Retiro en cajero automático
      description: Ejecuta un retiro atómico validando el saldo de la cuenta y el efectivo del cajero.
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                account_number:
                  type: string
                amount:
                  type: number
      responses:
        '200':
          description: Retiro exitoso. Retorna saldos actualizados.
        '400':
          description: Saldo insuficiente o cajero sin efectivo.
```

## ⚙️ Configuración de Desarrollo Local

1. Clonar el repositorio.
2. Instalar dependencias PHP: `composer install`.
3. Instalar dependencias Node: `npm install && npm run build`.
4. Duplicar `.env.example` a `.env` y configurar credenciales de **Supabase** (`DB_CONNECTION=pgsql`).
5. Generar clave: `php artisan key:generate`.
6. Levantar servidor local: `php artisan serve --host=0.0.0.0 --port=8000`.