<?php

namespace Controller;

use MVC\Router;
use Model\Property;
use PHPMailer\PHPMailer\PHPMailer;

class HomeController
{
  public static function index(Router $router)
  {
    $properties = Property::get(3);
    $home = true;
    $router->render('home/index', [
      'properties' => $properties,
      'home' => $home
    ]);
  }

  public static function aboutus(Router $router)
  {
    $router->render('home/aboutus');
  }

  public static function properties(Router $router)
  {
    $properties = Property::all();
    $router->render('home/properties', [
      'properties' => $properties
    ]);
  }

  public static function property(Router $router)
  {
    // get property id
    $id = validateOrRedirect('/');
    // get property to update
    $property = Property::find($id);
    $router->render('home/property', [
      'property' => $property
    ]);
  }

  public static function blog(Router $router)
  {
    $router->render('home/blog');
  }

  public static function entry(Router $router)
  {
    $router->render('home/entry');
  }

  private static function setContent($name, $email, $phone, $message, $subject, $budget, $contactType, $date, $time)
  {
    $content = '<html>';
    $content .= '<body>';
    $content .= '<h1>Tienes un nuevo mensaje</h1>';
    $content .= '<h2>Datos del emisor</h2>';
    $content .= '<p> <span style="font-weight: 700;">Nombre:</span> ' . $name . '</p>';
    if ($contactType === 'contact-phone') {
      $content .= '<p>Eligió ser contactado por Teléfono</p>';
      $content .= '<p> <span style="font-weight: 700;">Teléfono:</span> ' . $phone . '</p>';
      $content .= '<p> <span style="font-weight: 700;">Fecha:</span> ' . $date . '</p>';
      $content .= '<p> <span style="font-weight: 700;">Hora:</span> ' . $time . '</p>';
    } else {
      $content .= '<p?>Eligió ser contactado por Email</p>';
      $content .= '<p> <span style="font-weight: 700;">Email:</span> ' . $email . '</p>';
    }
    $content .= '<h2>Mensaje</h2>';
    $content .= '<p>' . $message . '</p>';
    $content .= '<h2>Datos Adicionales</h2>';
    $content .= '<p> <span style="font-weight: 700;">Objetivo:</span> ' . $subject . '</p>';
    $content .= '<p> <span style="font-weight: 700;">Presupuesto:</span> ' . numberToCurrency($budget) . '</p>';
    $content .= '</body>';
    $content .= '</html>';
    return $content;
  }

  public static function contact(Router $router)
  {
    $message = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $answers = $_POST;
      $mail = new PHPMailer();
      // config SMTP
      $mail->isSMTP();
      $mail->Host = 'sandbox.smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      $mail->Username = '0ebba45b59fd49';
      $mail->Password = '4cd930a1beb94c';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 2525;
      // config content
      $mail->setFrom('admin@bienesraices.com');
      $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
      $mail->Subject = '[Contacto] Tienes un nuevo mensaje';
      // enable HTML
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';
      // define content
      $name = $answers['name'];
      $email = $answers['email'];
      $phone = $answers['phone'];
      $message = $answers['message'];
      $option = $answers['options'];
      $budget = $answers['budget'];
      $contactType = $answers['contact-type'];
      $date = $answers['date'];
      $time = $answers['time'];
      $content = HomeController::setContent($name, $email, $phone, $message, $option, $budget, $contactType, $date, $time);
      $mail->Body = $content;
      $mail->AltBody = 'Tienes un nuevo mensaje';
      // send
      if ($mail->send()) $message = 'Mensaje enviado correctamente';
      else $message = 'El mensaje no se pudo enviar';
    }
    $router->render('home/contact', ['message' => $message]);
  }
}
