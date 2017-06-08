// -- 1. Importation de la Librairie Angular Core
import { Component } from '@angular/core';
import { Contact } from './shared/models/contact'

// -- 2. Déclaration du Composant
@Component({
  
  // -- 2.a : Le sélecteur pour le rendu dans l'application
  selector: 'app-root',
  
  // -- 2.b : Le contenu HTML de notre composant
  templateUrl: './app.component.html',
  
  // -- 2.c : Les styles CSS
  styleUrls: ['./app.component.css']
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

  // -- Si unContactEstCree j'appelle ma fonction ajouterContactDansListe
  ajouterContactDansListe(event) {
    console.log(event);
    this.Contacts.push(event.contact);
  }
}

  
