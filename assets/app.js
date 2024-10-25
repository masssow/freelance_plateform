/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';
import './styles/simple_home/style.scss';
import './js/home_js/landingpage';
import './js/vendor/skydash';
import '@popperjs/core';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'apexcharts';
import 'chart.js';
import 'datamaps';
import 'daterangepicker';
import 'dropzone';
import 'fullcalendar';
import $ from 'jquery';
require('bootstrap');
// home_simple
require('owl.carousel');
require('bootstrap');
import AOS from 'aos';
require('aos/dist/aos.css') ;
// const $ = require('jquery');
// import 'moment';
//import CSS

//Popper js
// document.addEventListener('DOMContentLoaded', function() {
//     const button = document.querySelector('#popper-button');
//     const tooltip = document.querySelector('#tooltip');

//     // Initialiser Popper.js sur un élément
//     createPopper(button, tooltip, {
//         placement: 'top',  // Position du popover
//     });
// });
 
// Exemple : création d'un graphique à barres
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('areaChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',  // Type de graphique (barre)
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Ventes',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

// Datamaps:
var map = new Datamap({
    element: document.getElementById('map'),
    scope: 'world',
    fills: {
        defaultFill: '#ABDDA4',
        authorHasTraveledTo: '#fa0fa0'
    },
    data: {
        USA: { fillKey: 'authorHasTraveledTo' },
        JPN: { fillKey: 'authorHasTraveledTo' },
        ITA: { fillKey: 'authorHasTraveledTo' },
        CRI: { fillKey: 'authorHasTraveledTo' },
        KOR: { fillKey: 'authorHasTraveledTo' }
    }
});


// apexcharts Exemple de création d'un graphique simple
var options = {
    chart: {
        type: 'line'
    },
    series: [{
        name: 'sales',
        data: [30, 40, 35, 50, 49, 60, 70, 91]
    }],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug']
    }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
// fin apexcharts

// Initialisation d'un graphique gauge
document.addEventListener("DOMContentLoaded", function() {
    var target = document.getElementById('gauge-chart'); // Sélectionner l'élément canvas
    var gauge = new Gauge(target).setOptions({
        angle: 0, // L'angle de départ de la jauge (0 - 180 degrés)
        lineWidth: 0.2, // Largeur de la ligne
        radiusScale: 1, // Échelle du rayon
        pointer: {
            length: 0.6, // Longueur de l'aiguille
            strokeWidth: 0.035, // Largeur de l'aiguille
            color: '#000000' // Couleur de l'aiguille
        },
        limitMax: false, // Si vrai, la jauge se limite à max
        limitMin: false, // Si vrai, la jauge se limite à min
        colorStart: '#6FADCF', // Couleur de départ
        colorStop: '#8FC0DA', // Couleur de fin
        strokeColor: '#E0E0E0', // Couleur du contour
    });
    gauge.maxValue = 3000; // Définir la valeur maximale
    gauge.setMinValue(0); // Définir la valeur minimale
    gauge.set(1250); // Définir la valeur actuelle
});

//Dropzone (sans le traitement automatique des fichiers)
Dropzone.autoDiscover = false;

const dropzoneOptions = {
    url: '/upload',  // Changez ceci selon l'URL de traitement des fichiers
    maxFilesize: 2,  // Limite de taille (en Mo)
    addRemoveLinks: true,
};

const myDropzone = new Dropzone("#my-dropzone", dropzoneOptions);

// apexcharts Exemple de création d'un graphique simple
var options = {
    chart: {
        type: 'line'
    },
    series: [{
        name: 'sales',
        data: [30, 40, 35, 50, 49, 60, 70, 91]
    }],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug']
    }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
// fin apexcharts

$(document).ready(function() {
        $('[data-toggle="popover"]').popover();

    $('#daterange').daterangepicker({
        startDate: moment().startOf('day'),
        endDate: moment().endOf('day'),
        locale: {
            format: 'MM/DD/YYYY'
        }
    });

    $('#datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        todayHighlight: true
    });

    $('#my-table').DataTable({
        paging: true,  // Pagination
        searching: true,  // Barre de recherche
        ordering: true,  // Tri des colonnes
        info: true,  // Informations sur la table
        language: {
            url: '/path/to/french.json'  // Chemin vers un fichier de langue personnalisé, si nécessaire
        }
    });

     $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      items: 1
  });

});