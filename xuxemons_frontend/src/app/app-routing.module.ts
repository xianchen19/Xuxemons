import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { LandscapeComponent } from './landscape/landscape.component';
import { ErrorComponent } from './error/error.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { AdminDashboardComponent } from './admin-dashboard/admin-dashboard.component';
import { loggedInGuard } from './guards/logged-in.guard';
import { noLoggedInGuard } from './guards/no-logged-in.guard';

const routes: Routes = [
  { path: '', redirectTo: '/landscape', pathMatch: 'full' },
  { path: 'login', component: LoginComponent, canActivate: [loggedInGuard] },
  { path: 'register', component: RegisterComponent, canActivate: [loggedInGuard] },
  { path: 'landscape', component: LandscapeComponent },
  { path: 'dashboard', component: DashboardComponent, canActivate: [noLoggedInGuard] }, 
  { path: 'admin', component: AdminDashboardComponent, canActivate: [noLoggedInGuard] },
  { path: 'error', component: ErrorComponent },
  { path: '**', redirectTo: '/error'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
