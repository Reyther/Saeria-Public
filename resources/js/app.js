/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import GenealogyComponent from './components/GenealogyComponent';

/**
 * Then we initialize all scripts on page load.
 */
window.addEventListener('load', function () {
  GenealogyComponent.init();
});
