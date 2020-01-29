import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { EmailService } from '../email.service';

@Component({
  selector: 'app-contact-us',
  templateUrl: './contact-us.component.html',
  styleUrls: ['./contact-us.component.scss']
})
export class ContactUsComponent implements OnInit {

  public loadingEmail = false;
  public contactForm: FormGroup;

  constructor(private emailService: EmailService) { }

  ngOnInit() {
    this.initForm();
  }

  initForm() {
    this.contactForm = new FormGroup({
      name: new FormControl('', [Validators.required]),
      phone: new FormControl('', [Validators.required]),
      email: new FormControl('', [Validators.required, Validators.email]),
    });
  }

  sendEmail() {
    this.loadingEmail = true;
    this.emailService.sendEmail(this.contactForm.value).subscribe((res: any) => {
      console.log('Success', res);
      this.loadingEmail = false;
    });
  }

}
