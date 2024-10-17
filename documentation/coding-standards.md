1. Convention de nommage des classes
Règles générales :
Utiliser la notation PascalCase
Le nom des classes doit être clair, précis et décrire la responsabilité de la classe.
Si possible, indiquer explicitement le rôle de la classe dans le nom (Service, Controller, Repository, etc.).
Exemples :
Contrôleurs (Controllers) :
ProjectController

Entités (Entities) :
Freelance
Client

Services :
NotificationService
PaymentService

Formulaires (Forms) :
ProjectFormType

2. Convention de nommage des fonctions/méthodes
Règles générales :
Utiliser la notation camelCase
Le nom de la fonction doit décrire l'action effectuée.
Toujours utiliser des verbres d’action pour les méthodes.
Les méthodes doivent être courtes et axées sur une seule responsabilité.
Exemples :

Pour un contrôleur (controller) :
public function createProject()
public function editProfile()

Pour un service :
public function calculateProjectCost()
public function sendNotification()

Pour un dépôt (repository) :
public function findProjectsByClient()
public function findFreelanceBySkills()

3. Convention de nommage des variables
Règles générales :
Utiliser la notation camelCase pour les variables.
Les noms des variables doivent être significatifs et clairs quant à leur contenu.
Éviter les abréviations ambiguës ou les noms trop courts.
Préférer des noms explicites même s’ils sont plus longs pour assurer la lisibilité.
Exemples :
Bonnes pratiques :
$projectTitle
$freelanceList
$projectDeadline
$clientBudget

Mauvaises pratiques :
$p // Trop court, peu explicite
$msg // Abréviation ambiguë

4. Convention de nommage des constantes
Règles générales :
Utiliser SNAKE_CASE avec toutes les lettres en majuscules.
Les constantes doivent être descriptives et représenter une valeur fixe.
Exemples :
Pour les valeurs par défaut ou les configurations :
const MAX_PROJECTS_PER_PAGE = 20;
const DEFAULT_FREELANCE_TAX = 0.15;
const PROJECT_STATUS_COMPLETED = 'completed';

5. Convention de naming des routes (Symfony)
Règles générales :
Utiliser la notation snake_case pour nommer les routes.
Nommer les routes en fonction de l’entité et de l’action.
Exemples :
freelance_profile_view:
  path: /freelance/{id}/profile
  controller: FreelanceController::view

client_project_create:
  path: /client/project/new
  controller: ProjectController::create

6. Convention de nommage des fichiers
Règles générales :
Utiliser PascalCase pour les noms de fichiers des classes.
Utiliser un nom explicite, représentatif de ce que contient le fichier.
Exemples :
Fichiers de contrôleurs : UserController.php, ProjectController.php
Fichiers d'entités : Freelance.php, Project.php

7. Conventions Git
Nommage des branches
Les branches doivent suivre une structure organisée pour faciliter la gestion du flux de développement.

Principales branches :

main : Branche de production stable.
develop : Branche de développement principale où sont intégrés les changements avant de passer en production.
Branches de fonctionnalités (features) : Utiliser des noms de branches explicites avec le préfixe feature/ suivi d’une courte description de la fonctionnalité.
Exemples :
feature/project-management
feature/user-authentication

Branches de corrections (bugfixes) : Utiliser le préfixe bugfix/ suivi d’une description du problème corrigé.
Exemples :
bugfix/fix-login-issue
bugfix/project-deadline-bug

Branches de correctifs urgents (hotfix) : Utiliser le préfixe hotfix/ pour des correctifs immédiats à appliquer en production.
Exemples :
hotfix/fix-crashing-endpoint

Conventions pour les messages de commit
Les messages de commit doivent être clairs et descriptifs.

Utiliser l'impératif pour décrire l'action effectuée dans le commit (comme si tu donnais un ordre à Git).

Structure recommandée :

Première ligne : Résumé concis (50 caractères max).
Lignes suivantes (facultatives) : Description plus détaillée si nécessaire.
Exemples :

Bonnes pratiques :

sql
Copier le code
Add user authentication system
Fix project listing page crash
Refactor ProjectService for better performance

Mauvaises pratiques :
css
Copier le code
Update code
Fix stuff
Change something

Messages de commit avec des préfixes (selon le type de changement) :
feat: : Pour une nouvelle fonctionnalité.
fix: : Pour une correction de bug.
refactor: : Pour une refonte du code sans ajout de fonctionnalité.
docs: : Pour des changements dans la documentation.
test: : Pour des ajouts ou des modifications dans les tests.
Exemples :
vbnet
Copier le code
feat: add user registration form validation
fix: correct project budget calculation
refactor: improve performance of ProjectRepository
docs: update API documentation for new endpoints