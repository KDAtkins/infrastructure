import {Component, OnInit} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Report} from "../classes/report";
import {ReportService} from "../services/report.service";
import {Category} from "../classes/category";
import {CategoryService} from "../services/category.service";
import {Image} from "../classes/image";
import {ImageService} from "../services/image.service";
import {Status} from "../classes/status";
import {subscribeToResult} from "rxjs/util/subscribeToResult";

@Component({
	selector: "report-public-view",
	templateUrl: "./templates/report-public-view.html",
})

export class ReportPublicViewComponent implements OnInit{
	reportPublicViewForm: FormGroup;

	report: Report = new Report(null, null, null, null, null, null, null);

	category: Category = new Category(null, null);

	categories: Category[] = [];

	image: Image = new Image(null, null, null, null, null);

	images: Image[] = [];

	data: string;

	//declare needed state variables for later use
	status: Status = null;

	constructor(
		private formBuilder: FormBuilder,
		private reportService: ReportService,
		private imageService: ImageService,
		private categoryService: CategoryService) {}

	ngOnInit(): void {

		this.listCategories();

		this.reportService.dataString$.subscribe(
			data => {
				this.data = data;
				console.log(data);
			});
	}

	listCategories(): void {
		this.categoryService.getAllCategories()
			.subscribe(categories => this.categories = categories);
	}

	getReport(): void {
		this.reportService.getReport(this.report.reportId)
			.subscribe(report => this.report = report);
			this.reportPublicViewForm.setValue(this.report);

	}
}