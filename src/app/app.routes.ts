//import needed @angularDependencies
import {RouterModule, Routes} from "@angular/router";

//import all needed Interceptors
import {APP_BASE_HREF} from "@angular/common";
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {DeepDiveInterceptor} from "./services/deep.dive.intercepters";


// import all components
import {InfrastructureAppComponent} from "./components/infrastructure-app.component";
import {NavbarComponent} from "./components/navbar.component";
import {FootComponent} from "./components/foot.component";
import {HomeViewComponent} from "./components/home-view.component";
import {ReportsMadeComponent} from "./components/reports-made.component";
import {ReportPublicViewComponent} from "./components/report-public-view.component";
import {ReportSubmitComponent} from "./components/report-submit.component";
import {AdminDashboardComponent} from "./components/admin-dashboard.component";
import {SignUpComponent} from "./components/sign-up.component";
import {SignInComponent} from "./components/sign-in.component";
import {SignOutComponent} from "./components/sign-out.component";
import {CategoryComponent} from "./components/category.component";
import {ReportListedByCategoryComponent} from "./components/report-listed-by-category.component";
import {ReportAdminViewComponent} from "./components/report-admin-view.component";
import {CommentComponent} from "./components/comment.component";
import {FileSelectDirective} from "ng2-file-upload";



// Previous Order of Components
// import {AdminDashboardComponent} from "./components/admin-dashboard.component";
// import {HomeViewComponent} from "./components/home-view.component";
// import {NavbarComponent} from "./components/navbar.component";
// import {FootComponent} from "./components/foot.component";
// import {ReportAdminViewComponent} from "./components/report-admin-view.component";
// import {ReportPublicViewComponent} from "./components/report-public-view.component";
// import {ReportsMadeComponent} from "./components/reports-made.component";
// import {ReportSubmitComponent} from "./components/report-submit.component";
// import {CommentComponent} from "./components/comment.component";
// import {SignInComponent} from "./components/sign-in.component";
// import {SignUpComponent} from "./components/sign-up.component";
// import {SignOutComponent} from "./components/sign-out.component";
// import {ReportListedByCategoryComponent} from "./components/report-listed-by-category.component";
// import {InfrastructureAppComponent} from "./components/infrastructure-app.component";
// import {CategoryComponent} from "./components/category.component";
// import {FileSelectDirective} from "ng2-file-upload";


// import services
import {AuthService} from "./services/auth.service";
import {CookieService} from "ng2-cookies";
import {JwtHelperService} from "@auth0/angular-jwt";
import {UserService} from "./services/user.service";
import {ProfileService} from "./services/profile.services";
import {ReportService} from "./services/report.service";
import {CommentService} from "./services/comment.service";
import {SessionService} from "./services/session.service";
import {SignInService} from "./services/sign.in.service";
import {SignUpService} from "./services/sign.up.service";
import {CategoryService} from "./services/category.service";
import {ImageService} from "./services/image.service";
import {SignOutService} from "./services/sign.out.service";


//an array of the components that will be passed off to the module
export const allAppComponents = [
	AdminDashboardComponent,
	HomeViewComponent,
	NavbarComponent,
	ReportAdminViewComponent,
	ReportPublicViewComponent,
	ReportsMadeComponent,
	ReportSubmitComponent,
	CommentComponent,
	InfrastructureAppComponent,
	FootComponent,
	SignInComponent,
	SignUpComponent,
	SignOutComponent,
	ReportListedByCategoryComponent,
	CategoryComponent,
	FileSelectDirective
];

//an array of routes that will be passed of to the module
export const routes: Routes = [
	{path: "admin-dashboard", component: AdminDashboardComponent},
	{path: "report-admin-view", component: ReportAdminViewComponent},
	{path: "report-public-view", component: ReportPublicViewComponent},
	{path: "reports-made", component: ReportsMadeComponent},
	{path: "sign-in", component: SignInComponent},
	{path: "sign-up", component: SignUpComponent},
	{path: "sign-out", component: SignOutComponent},
	{path: "report-listed-by-category", component: ReportListedByCategoryComponent},
	{path: "report-submit", component: ReportSubmitComponent},
	{path: "comment", component: CommentComponent},
	{path: "foot", component: FootComponent},
	{path: "category", component: CategoryComponent},
	{path: "infrastructure-app", component: InfrastructureAppComponent},
	{path: "", component: HomeViewComponent}
];

// an array of services that will be passed off to the module
const services : any[] = [
	AuthService,
	CookieService,
	JwtHelperService,
	ProfileService,
	CategoryService,
	ImageService,
	ReportService,
	CommentService,
	SessionService,
	SignInService,
	SignOutService,
	SignUpService,
	UserService];

// an array of misc providers
export const providers: any[] = [
	{provide: APP_BASE_HREF, useValue: window["_base_href"]},
	{provide: HTTP_INTERCEPTORS, useClass: DeepDiveInterceptor, multi: true},
];

export const appRoutingProviders: any[] = [providers, services ];

export const routing = RouterModule.forRoot(routes);