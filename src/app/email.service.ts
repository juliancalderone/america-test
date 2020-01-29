import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { Resolve } from '@angular/router';
// import 'rxjs/add/operator/map';
import { map } from 'rxjs/operators';
// import 'rxjs/add/operator/catch';
import { HttpClient } from '@angular/common/http';

@Injectable()
export class EmailService {
  private emailUrl = 'assets/email.php';

  constructor(private http: HttpClient) {

  }

  sendEmail(message): Observable<any> | any {
    return this.http.post(this.emailUrl, message).pipe(
      map(response => {
        console.log('Sending email was successfull', response);
        alert('Gracias por contactarse con nosotros, nos pondremos en contacto a la brevedad.');
        window.location.reload();
        return response;
      })
    );
  }
}
