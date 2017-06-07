// -- 1. Importation de la Librairie Angular Core
import { Component } from '@angular/core';

// -- Déclaration d'une Classe Contact
export class Contact {
  id : number;
  fullname: string;
  username: string;
}

// -- 2. Déclaration du Composant
@Component({
  
  // -- 2.a : Le sélecteur pour le rendu dans l'application
  selector: 'app-root',
  
  // -- 2.b : Le contenu HTML de notre composant
  // templateUrl: './app.component.html',
  template: `
    <header>
      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <a href="#" class="navbar-brand">Mes Contacts</a>
        </div>
      </nav>
    </header>

    <div class="row">
      <div class="col-sm-4">

        <!-- *ngIf: Permet de faire le re,du HTML de la div, que si le tableau Contacts contient des objets -->
        <div *ngIf="Contacts">
          
          <ul class="list-group list-contacts">
            <li class="list-group-item" *ngFor="let contact of Contacts" (click)="choisirContact(contact)" [class.active]="contact === contactActif">
              {{contact.fullname}} <i>({{contact.username}})</i>
            </li>
          </ul>

        </div> <!-- /div if Contacts -->

      </div> <!-- /div .col-sm-4 -->

      <div class="col-sm-8">

        <div class="jumbotron" *ngIf="contactActif">
          
          <h2>{{contactActif.fullname}}</h2>
          <small>{{contactActif.username}}</small>

          <!-- Avec l'expression {{ }} j'affiche le contenu de la variable dans l'application -->
          <!-- <h3 class="text-center">Gestion de mes {{title}} !</h3> -->

        </div> <!-- /div .jumbotron -->

        <div class="jumbotron" *ngIf="!contactActif">
          
          <span class="glyphicon glyphicon-hand-left"></span>
          <h2>Bonjour, choisis un contact !</h2>

        </div> <!-- /div .jumbotron -->

      </div> <!-- /div .col-sm-8 -->

    </div> <!-- /div .row -->

    

    <!-- <p>Bonjour {{Contact.fullname}} <i>({{Contact.username}})</i></p> -->

    

    <footer class="text-center">
      Copyright &copy; 2017
    </footer>
  `,
  
  // -- 2.c : Les styles CSS
  // styleUrls: ['./app.component.css']
  styles: [`
    .list-contacts li {
      cursor: pointer;
    }
  `]
})

// -- Notre code JS
export class AppComponent {
  // -- Déclaration d'une variable title
  title = 'contacts';

  // -- Déclaration d'un objet Contact
  Contact = {
    id      : 1,
    fullname: 'Quentin LEFEVRE',
    username: 'KintoLef',
  }

  // -- Je travail avec des Contacts
  Contacts: Contact[] = [
    {id: 1, fullname: 'Quentin LEFEVRE', username: 'KintoLef',},
    {id: 2, fullname: 'Tanguy MANAS', username: 'TManas',},
    {id: 3, fullname: 'Yimin JI', username: 'YiJi',},
  ]

  // -- Choix de mon utilisateur actif
  contactActif: Contact;

  // -- Ma fonction choisir contact, prend un contact en paramètre, et le transmet à la variable contactActif.
  choisirContact(contactchoisiparuser) {
    this.contactActif = contactchoisiparuser;
    console.log(this.contactActif);
  }
}

  
