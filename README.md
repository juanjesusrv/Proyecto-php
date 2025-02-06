# Proyecto-php
Proyecto final de PHP, este programa va a administrar el sistema de gestión de reservas del salón de actos en un instituto. En el programa existen los siguientes usuarios:
Profesores: Los profesores podrán ver los tramos libres en los que pueden reservar, además tendrán un listado con sus reservas y podrán cancelarlas.
Vicedirector: Puede hacer lo mismo que los profesores y además pueden añadir o eliminar profesores (!Al eliminar un profesor también se deben borrar sus reservas)

**---- Requisitos ----**

-- Salón de actos --

  - Solo podrán haber 3 grupos simultaneamente por hora
  - Son 6 horas por dia

-- Profesores --

  - Tener cuenta propia y poder logearse
  - Reservar tramos libres
  - Listar sus reservas
  - Anular sus propias reservas

  -- Vicedirector --
  
    - Extiende la clase profesores
    - Este podrá crear y eliminar profesores
    - Ver todas las reservas

**---- Diagramas ----**
Los diagramas a desarrollar son:
  - Diagrama entidad-relación y modelo relacional
  - Diagrama de flujo
  - Diagrama de clases
  - Diagrama de casos de usos
