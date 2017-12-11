import {Component, OnInit} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Report} from "../classes/report";
import {ReportService} from "../services/report.service";
import {Category} from "../classes/category";
import {CategoryService} from "../services/category.service";
import {Image} from "../classes/image";
import {ImageService} from "../services/image.service";
import {Status} from "../classes/status";

@Component({
	selector: "report-public-view",
	templateUrl: "./templates/report-public-view.html",
})

export class ReportPublicViewComponent implements OnInit{
	reportPublicViewForm: FormGroup;

	report: Report = new Report(null, null, null, null, null, null, null);

	category: Category = new Category(null,null);

	image: Image = new Image(null, null, null, null, null);

	//declare needed state variables for later use
	status: Status = null;

	constructor(private formBuilder: FormBuilder, private reportService: ReportService, private imageService: ImageService){}

	ngOnInit(): void {
		//this.getReport()
	}



	// getReport(): void {
	// 	this.reportService.getReport(this.report.reportId)
	// 		.subscribe(report => this.report = report);
	// }
}