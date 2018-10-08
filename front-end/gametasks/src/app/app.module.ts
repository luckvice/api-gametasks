import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { ListaJogosComponent } from './lista-jogos/lista-jogos.component';
import { ListaPlataformasComponent } from './lista-plataformas/lista-plataformas.component';



@NgModule({
  declarations: [
    AppComponent,
    ListaJogosComponent,
    ListaPlataformasComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
