import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaPlataformasComponent } from './lista-plataformas.component';

describe('ListaPlataformasComponent', () => {
  let component: ListaPlataformasComponent;
  let fixture: ComponentFixture<ListaPlataformasComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListaPlataformasComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListaPlataformasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
