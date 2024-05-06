import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { LandscapeComponent } from './landscape/landscape.component';
import { ErrorComponent } from './error/error.component';
import { NavbarComponent } from './navbar/navbar.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { DashboardComponent } from './dashboard/dashboard.component';
import { AdminDashboardComponent } from './admin-dashboard/admin-dashboard.component';
import { ContactoComponent } from './contacto/contacto.component';
import { EditXuxemonComponent } from './admin-dashboard/edit-xuxemon/edit-xuxemon.component';
import { CreateXuxemonComponent } from './admin-dashboard/create-xuxemon/create-xuxemon.component';
import { InventarioComponent } from './inventario/inventario.component';
import { ColeccionComponent } from './coleccion/coleccion.component';
import { XuxedexComponent } from './xuxedex/xuxedex.component';
import { HospitalComponent } from './hospital/hospital.component';
import { ConfiguracionComponent } from './configuracion/configuracion.component';
import { AmigosComponent } from './amigos/amigos.component';
import { MatIconModule } from '@angular/material/icon';
import { provideAnimationsAsync } from '@angular/platform-browser/animations/async';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    LandscapeComponent,
    ErrorComponent,
    NavbarComponent,
    DashboardComponent,
    AdminDashboardComponent,
    EditXuxemonComponent,
    CreateXuxemonComponent,
    InventarioComponent,
    ContactoComponent,
    ColeccionComponent,
    ConfiguracionComponent,
    XuxedexComponent,
    HospitalComponent,
    AmigosComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    FormsModule,
    MatIconModule
  ],
  providers: [
    provideAnimationsAsync()
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
