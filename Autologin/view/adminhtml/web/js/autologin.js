/**
 * @author Actecnology Team
 * @copyright Copyright (c) 2016 Actecnology (https://actecnologies.com/)
 * @package Actecnology_Autologin
 */

define([
    'jquery'
], function ($) {

    return {
      adminAutologin:  adminAutologin
    };

    /**
     * Performs automatic login process
     * @param {String} username
     * @param {String} password
     */
    function adminAutologin(username, password) {
        $('#username').val(username);
        $('#login').val(password);
        $('.action-login').click();
        $('#login-form').hide();
        $('#autologin-message').show();
    }
});