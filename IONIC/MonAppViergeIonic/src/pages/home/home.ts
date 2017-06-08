import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ActualitesPage } from '../actualites/actualites';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  actualites = ActualitesPage;

  constructor(){

  }

}
