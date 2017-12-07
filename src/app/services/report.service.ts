import {Injectable}  from "@angular/core";

import {Status} from "../classes/status";
import {Report} from "../classes/report";
import {Observable} from "rxjs/Observable";
import {HttpClient} from "@angular/common/http";

@Injectable ()
export class ReportService {

	constructor(
		protected http : HttpClient
	) {}

	// define the API endpoint
	private reportUrl = "api/report/";


	// call to the report API and delete the report in question
	deleteReport(reportId : string) : Observable<Status> {
		return(this.http.delete<Status>(this.reportUrl + reportId));
	}

	// call to the report API and create the report in question
	createReport(report : Report) : Observable<Status> {
		return(this.http.post<Status>(this.reportUrl, report));
	}

	// call to the report API and get a report object based on its ID
	getReport(reportId : string) : Observable<Report> {
		return(this.http.get<Report>(this.reportUrl + reportId));
	}

	// call to the API and get an array of reports based off the categoryId
	getReportByReportId(reportId : string) : Observable<Report[]> {
		return(this.http.get<Report[]>(this.reportUrl + reportId));
	}

	getReportByCategoryId(reportCategoryId: string) : Observable<Report[]> {
		return(this.http.get<Report[]>(this.reportUrl + reportCategoryId));
	}

	//call to the API and get an array of all the reports in the database
	getAllReports() : Observable<Report[]> {
		return(this.http.get<Report[]>(this.reportUrl));
	}

}
