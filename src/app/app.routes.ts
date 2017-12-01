import {RouterModule, Routes} from "@angular/router";
import {APP_BASE_HREF} from "@angular/common";
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {DeepDiveInterceptor} from "./services/deep.dive.intercepters";

// import all components
import {SplashComponent} from "./components/splash.component";
import {AdminDashboardComponent} from "./components/admin-dashboard.component";
import {NavbarComponent} from "./components/navbar.component";
import {FooterComponent} from "./components/footer.component";
import {ReportAdminViewComponent} from "./components/report-admin-view.component";
import {ReportPublicViewComponent} from "./components/report-public-view.component";
import {ReportsMadeComponent} from "./components/reports-made.component";
import {ReportSubmitComponent} from "./components/report-submit.component";


// import services
import {UserService} from "./services/user.service";


export const allAppComponents = [
	SplashComponent,
	AdminDashboardComponent,
	NavbarComponent,
	ReportAdminViewComponent,
	ReportPublicViewComponent,
	ReportsMadeComponent,
	ReportSubmitComponent,
	FooterComponent
];

export const routes: Routes = [
	{path: "", component: SplashComponent},
	{path: "admin-dashboard", component: AdminDashboardComponent},
	{path: "report-admin-view", component: ReportAdminViewComponent},
	{path: "report-public-view", component: ReportPublicViewComponent},
	{path: "reports-made", component: ReportsMadeComponent}
];

export const appRoutingProviders: any[] = [
	{provide: APP_BASE_HREF, useValue: window["_base_href"]},
	{provide: HTTP_INTERCEPTORS, useClass: DeepDiveInterceptor, multi: true},
	UserService
];

export const routing = RouterModule.forRoot(routes);