import {Component, OnInit, Input} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

import {AuthService} from "../services/auth.service";
import {Profile} from "../classes/profile";
import {ProfileService} from "../services/profile.services";
import {Report} from "../classes/report";
import {ReportService} from "../services/report.service";
import {Category} from "../classes/category";
import {CategoryService} from "../services/category.service";
import {Comment} from "../classes/comment";
import {CommentService} from "../services/comment.service";
import {Image} from "../classes/image";
import {ImageService} from "../services/image.service";
import {Status} from "../classes/status";


@Component({
	selector: "report-admin-view",
	templateUrl: "./templates/report-admin-view.html",
})

export class ReportAdminViewComponent implements OnInit {
	@Input() commentContent: Comment;

	reportAdminViewForm: FormGroup;

	deleted: boolean = false;

	category: Category = new Category(null, null);

	report: Report = new Report(null, null, null, null, null, null, null, null, null, null);

	image: Image = new Image(null, null, null, null, null);

	comment: Comment = new Comment(null, null, null, null, null);

	profile: Profile = new Profile(null, null, null, null, null, null);

	//declare needed state variables for later use
	status: Status = null;

	constructor(private authService: AuthService, private formBuilder: FormBuilder, private profileService: ProfileService, private reportService: ReportService, private categoryService: CategoryService, private commentService: CommentService, private imageService: ImageService) {
	}

	ngOnInit() : void {

		this.getReportByReportId();

		this.reportAdminViewForm = this.formBuilder.group({
			reportStatus: ["", [Validators.required]],
			reportUrgency: ["", [Validators.min(0),Validators.max(5),Validators.required]],
			commentContent: ["", [Validators.maxLength(500), Validators.required]]
		});
	}

	getReportByReportId(): void {
		this.reportService.getReportByReportId(this.report.reportId)
			.subscribe(report => this.report = report);
	}

	deleteReport(): void {
		this.reportService.deleteReport(this.report.reportId)
			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					this.deleted = true;
					this.report = new Report(null, null, null, null, null, null, null, null, null, null);
				}
			})
	}

	createComment(): void {
	let comment = new Comment(null, null, null, this.reportAdminViewForm.value.commentContent, null);

		this.commentService.createComment(comment)
			.subscribe(status =>{
				this.status = status;
				if(this.status.status === 200) {
					this.reportAdminViewForm.reset();
					alert(this.status.message);
				}
			})
	}

	editComment() : void {
		this.commentService.editComment(this.comment)
			.subscribe(status => this.status = status);
	}

	deleteComment() : void {
		this.commentService.deleteComment(this.comment.commentId)
			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					this.deleted = true;
					this.comment = new Comment(null, null, null, null, null);
				}
			})
	}

}