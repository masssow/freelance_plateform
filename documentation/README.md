Joined Table Inheritance (JTI)

{# <?php
$i = 1;
$cfg['Servers'][$i]['auth_type'] = 'cookie'; 
$cfg['Servers'][$i]['host'] = 'db'; 
$cfg['Servers'][$i]['user'] = 'root'; 
$cfg['Servers'][$i]['password'] = 'root_password'; 
$cfg['Servers'][$i]['AllowNoPassword'] = false; 
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = true;  #}
TODO : 
-protected page (e.g. redirect to /login), uncomment this method and make this class security.yml
-Entites en rapport la collaboration ainsi que ses relations:
Espace dédié à la collaboration sur un projet.
7. EspaceCollaboratif (CollaborativeSpace)
    Propriétés :
    id (int) : non-nullable
    nom (string) : non-nullable
    description (text) : nullable
    dateCréation (DateTime) : non-nullable
    Relations :
    projet (OneToOne -> Projet) : non-nullable
    freelances (ManyToMany -> Freelance) : nullable
    taches (OneToMany -> Tâche) : nullable.

8. Tâches à accomplir dans un projet collaboratif. 
    Tâche (Task)
    Propriétés :
    id (int) : non-nullable
    nom (string) : non-nullable
    description (text) : nullable
    statut (string) : non-nullable (à faire, en cours, terminée)
    dateLimite (DateTime) : nullable
    Relations :
    espaceCollaboratif (ManyToOne -> EspaceCollaboratif) : non-nullable
    freelanceResponsable (ManyToOne -> Freelance) : nullable




STRUCTURE DOSSIERS:

src/
└── Domain/
    ├── Account/
    │   ├── Controller/
    │   │   └── AccountController.php         
    │   ├── Service/
    │   ├── Form/
    │   └── Repository/
    ├── Project/
    │   ├── Controller/
    │   │   └── ProjectController.php         
    │   ├── Service/
    │   ├── Form/
    │   └── Repository/
    ├── Notification/
    │   ├── Controller/
    │   │   └── NotificationController.php     
    │   ├── Service/
    │   └── Repository/
    ├── Security/
    │   ├── Controller/
    │   ├── Service/
    │   └── ...
    └── └── HomeController.php    # Contrôleurs pages générales e.g page Home et autres.


But : Donner une vue d'ensemble du projet, ses objectifs, et un guide rapide pour démarrer.
Contenu recommandé :
Nom et d
escription du projet.
Objectifs du projet.
Fonctionnalités principales.
Aperçu rapide des technologies utilisées.
Instructions pour le démarrage rapide (installation, exécution, etc.).
Liens vers les autres sections de la documentation (installation, architecture, etc.).