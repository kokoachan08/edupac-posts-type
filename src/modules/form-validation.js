import $ from 'jquery';

class edu003_formValidation{

    constructor(){
        this.validate();
    }
    validate(){
        $.validator.addMethod('validateName', function (value){
            return  /^[^0-9<>]+[a-zA-Z0-9]+(?:(?:\s*(?:to|[\n|;,])\s*);)*$/g.test(value)
        }, 'Mohon masukkan nama yang valid!');

        $.validator.addMethod('validateEducationalInstitute', function (value){
            return  /^[^0-9<>]+[a-zA-Z0-9]+(?:(?:\s*(?:to|[\n|;,])\s*);)*$/g.test(value)
        }, 'Mohon masukkan sekolah atau universitas yang valid!');
            
        $.validator.addMethod('validateEmail', function (value){
            return  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/g.test(value)
        }, 'Mohon masukkan email yang valid!');

        $.validator.addMethod('validatePhoneNumber', function (value){
            return  /^[0-9]*$/g.test(value)
        }, 'Mohon masukkan nomor yang valid!');

        $.validator.addMethod('validateAddress', function (value){
            return  /^([a-z0-9\s_.-]+,)*([a-z0-9\s]+){1}/i.test(value)
        }, 'Mohon masukkan alamat yang valid!');
        
        $.validator.addMethod('validateProgram', function (value){
            return  /^[^0-9<>]+[a-zA-Z0-9]+(?:(?:\s*(?:to|[\n|;,])\s*);)*$/g.test(value)
        }, 'Mohon masukkan program yang valid!');

        $.validator.addMethod('validateScore', function(value){
            return !isNaN(value);
        }, 'Mohon masukkan skor berupa angka');

        $.validator.addMethod('validateQuestion', function (value, element){
            return this.optional(element) || /^[^<>]+[a-zA-Z0-9\s_.-\\?]+(?:(?:\s*(?:to|[\n|;,])\s*);)*$/.test(value)
        }, 'Mohon masukkan pertanyaan yang valid!' );

    }
}
export default edu003_formValidation;