import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ListaJogosComponent } from './lista-jogos/lista-jogos.component';
import { ListaPlataformasComponent } from './lista-Plataformas/lista-Plataformas.component';

const routes: Routes = [
    { path:  '', redirectTo:  'listaJogos', pathMatch:  'full' },
{
    path:  'listaJogos',
    component:  ListaJogosComponent
},
{
    path:  'listaPlataformas',
    component:  ListaPlataformasComponent
}
];


@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }