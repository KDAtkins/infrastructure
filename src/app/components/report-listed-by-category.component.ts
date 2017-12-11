/*
this is used to list all reports based on category or something
*/

import {Component, OnInit} from "@angular/core";
import {JwtHelperService} from '@auth0/angular-jwt';
import {ReportService} from "../services/report.service";
import {CategoryService} from "../services/category.service";
import {Report} from "../classes/report";
import {Category} from "../classes/category";
import {Status} from "../classes/status";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs/Observable";
import {Router} from "@angular/router";

declare let $: any;

@Component({
	templateUrl: "./templates/report-listed-by-category.html",
	selector: "report-listed-by-category"
})

export class ReportListedByCategoryComponent implements OnInit {

	reportListedByCategoryForm: FormGroup;

	status: Status = null;

	reports: Report[] = [];

	report: Report = new Report(null, null, null, null, null, null, null);

	categories: Category[] = [];

	category: Category = new Category(null, null);


	constructor(
		private router: Router,
		private formBuilder : FormBuilder,
		private reportService : ReportService,
		private categoryService : CategoryService,
		private jwtHelperService : JwtHelperService) {}

	// life cycling before George's eyes

	ngOnInit() : void {

		this.listReports();

		this.listCategories();
	}

	listReports() : void {
		this.reportService.getAllReports()
			.subscribe(reports => this.reports = reports);
	}

	listCategories() : void {
		this.categoryService.getAllCategories()
			.subscribe(categories => this.categories = categories);
	}

	getCategorybyCategoryId(categoryId : string) : Category {
		return (this.categories.find(searchCategory => searchCategory.categoryId === categoryId));
	}

	// needs to be fixed
    getReportByCategoryId() : void {
		this.reportService.getReportByReportCategoryId(this.report.reportCategoryId)
			.subscribe((reports: any) => this.report = reports);
	}

}