# assignment

![alt text](https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGmUav4XCpZdfDU2lJqSlTRsA1daMrRA1egA&usqp=CAU)


Opdracht Bader

Setup:
- Maak een nieuw Laravel 8 project aan op een Homestead omgeving die op Vagrant draait.
- Zorg dat er een standaard Homestead mysql database aan de Laravel applicatie gekoppeld zit.
- Maak 3 nieuwe modellen aan die elk een migration/factory/seeder hebben en noem deze User/Membership/Team
- Zorg dat er dummydata beschikbaar is

Uitvoering:

User model properties:
- id
- name

Team model properties:
- id
- name

Membership model properties:
- id
- user
- membership

Controllers
- UserController
- TeamController
- MembershipController

Opdracht
Maak binnen je Controller-directory een bestand dat ControllerFactory heet.
Zorg dat de ControllerFactory een paar CRUD methodes heeft.
Zorg dat alle controllers deze methodes overerven.

Eindproduct:
- Laat zien dat je CRUD-methodes uit kan voeren op alle controllers (print screens van uitkomsten in JSON)
- Commit op https://github.com/apostledev/assignment
