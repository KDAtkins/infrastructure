import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {SignUp} from "../classes/Sign.up";
import {Observable} from "rxjs/Observable";
import {Status} from "../classes/status";
import {Profile} from "../classes/profile";

@Injectable()
export class SignUpService {
	constructor(protected http: HttpClient) {

	}

	private signUpUrl = "api/sign-up/";

	// call to the API and get a Category by Category Name
	getProfileByProfileEmail (ProfileEmail: string) :Observable<Profile> {
		return(this.http.get<Profile>(this.signUpUrl + "?ProfileEmail=" + ProfileEmail));
	}

	createProfile(signUp: SignUp) : Observable<Status> {
		return(this.http.post<Status>(this.signUpUrl, signUp));

	}
}