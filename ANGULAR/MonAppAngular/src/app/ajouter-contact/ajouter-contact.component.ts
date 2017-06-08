import { Component, Output, EventEmitter } from '@angular/core';
import { Contact } from '../shared/models/contact';

@Component({
  selector: 'app-ajouter-contact',
  templateUrl: './ajouter-contact.component.html',
  styleUrls: ['./ajouter-contact.component.css']
})
export class AjouterContactComponent {
  // -- Définition de notre évènement
  @Output() unContactEstCree = new EventEmitter();

  nouveauContact: Contact = new Contact();
  active: boolean = true;

  // -- Fonction appeler après le submit du formulaire
  submitContact(){
    // -- Ici, à la soumission, j'émet mon évènement
    this.unContactEstCree.emit({ contact: this.nouveauContact});

    // -- Je récupère le nouveau contact
    console.log(this.nouveauContact);

    // -- Après la soumission je réinitialise le nouveau contact
    this.nouveauContact = new Contact();

    // -- Je passe ensuite mon formulaire à false, puis immédiatement après à true. Ce qui a pour conséquence de la détruire dans le DOM et de le re-créer
    this.active = false;
    setTimeout(()=> this.active = true, 0);
  }
} 