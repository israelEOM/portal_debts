<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CadastroFormRequest extends FormRequest
{
    public $rules;
    public $message;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules()
    {
        $this->rules = [
            'nome' => 'required',
            'cpf' => 'required|cpf',
            'dtNascimento' => 'required',
            'estado_civil' => 'required',
            'sexo' => 'required',
            'nomeMae' => 'required',

            // rg
            'documentos.img_cpf.img' => 'required',
            'documentos.rg.numero' => 'required',
            'documentos.rg.orgaoEmissor' => 'required',
            'documentos.rg.estadoEmissor' => 'required',
            'documentos.rg.dtEmissao' => 'required',
            'documentos.rg.img' => 'required',
            // titulo

            // comprovante residencia 
            'endereco.cep' => 'required',
            // 'endereco.numero' => 'required',
            'endereco.logradouro' => 'required',
            'endereco.bairro' => 'required',
            'endereco.localidade' => 'required',
            'endereco.uf' => 'required',
            'endereco.img' => 'required',
            'documentos.selfie.img' => 'required',
            // exame_admissional
            'documentos.exame_admissional.img' => 'required',
            'documentos.exame_admissional.img2' => 'required',
            // / exame_admissional

        ];

        if($this->tipo == 0){
            if($this->maiorIdade){
                $this->rules['documentos.titulo.numero'] = 'required';
                $this->rules['documentos.titulo.zona'] = 'required';
                $this->rules['documentos.titulo.secao'] = 'required';
                $this->rules['documentos.titulo.img'] = 'required';
                $this->rules['primeiro_emprego'] = 'required';
                $this->rules['possui_filhos'] = 'required';
            }
            $this->validateCtps();
            $this->rules['documentos.historico_escolar.img'] = 'required';
            $this->rules['documentos.bilhete_unico.img'] = 'required';
            // $this->rules['documentos.cartao_sus.img'] = 'required';

            if($this->primeiro_emprego == 1){
                $this->rules[ 'documentos.pis.numero'] = 'required';
                $this->rules[ 'documentos.pis.img'] = 'required';
            }
            if($this->sexo == 2 && $this->maiorIdade){
                $this->rules[ 'documentos.reservista.numero'] = 'required';
                $this->rules[ 'documentos.reservista.img'] = 'required';
            }
        }

        if($this->tipo == 1){
            $this->rules['documentos.estagio.ra'] = 'required';
            $this->rules['documentos.estagio.declaracao_estagio'] = 'required';
            $this->rules['documentos.nit'] = 'required';

        }

        if($this->tipo == 2 ){
            if($this->maiorIdade){
                $this->rules['documentos.titulo.numero'] = 'required';
                $this->rules['documentos.titulo.zona'] = 'required';
                $this->rules['documentos.titulo.secao'] = 'required';
                $this->rules['documentos.titulo.img'] = 'required';
                $this->rules['primeiro_emprego'] = 'required';
                $this->rules['possui_filhos'] = 'required';
            }
            //$this->rules['documentos.foto3x4.img'] = 'required';
            $this->rules['documentos.estagio.ra'] = 'required';
            $this->rules['documentos.estagio.declaracao_estagio'] = 'required';
            $this->validateCtps();
            $this->rules[ 'documentos.bilhete_unico.img'] = 'required';
            // $this->rules['documentos.cartao_sus.img'] = 'required';

            if($this->primeiro_emprego == 1){
                $this->rules[ 'documentos.pis.numero'] = 'required';
                $this->rules[ 'documentos.pis.img'] = 'required';
            }
            if($this->sexo == 2 && $this->maiorIdade){
                $this->rules[ 'documentos.reservista.numero'] = 'required';
                $this->rules[ 'documentos.reservista.img'] = 'required';
            }
        }

        if(!$this->maiorIdade)
        {
            $this->rules['parentesco.responsavel.nome'] = 'required';
            $this->rules['parentesco.responsavel.cpf'] = 'required';
            $this->rules['parentesco.responsavel.dtNascimento'] = 'required';
            $this->rules['parentesco.responsavel.rg'] = 'required';
            $this->rules['parentesco.responsavel.OrgaoEmissaoRg'] = 'required';
            $this->rules['parentesco.responsavel.EstadoEmissaoRg'] = 'required';
            $this->rules['parentesco.responsavel.dtEmissaoRg'] = 'required';
            $this->rules['parentesco.responsavel.img'] = 'required';
    // $this->rules['documentos.responsavel.dtEmissaoRg'] = 'required';

        }
// dd($this->estado_civil);

        if($this->estado_civil == 1)
        {
            $this->rules['parentesco.conjuge.nome'] = 'required';
            $this->rules['parentesco.conjuge.cpf'] = 'required';
            $this->rules['parentesco.conjuge.certidao_casamento'] = 'required';
        }

        return $this->rules;
    }

    public function validateCtps()
    {
        if($this->ctps_digital == 1){
           $this->rules['documentos.carteira_trabalho.ctps'] = 'required';
           $this->rules['documentos.carteira_trabalho.serie'] = 'required';
           $this->rules['documentos.carteira_trabalho.dtEmissao'] = 'required';
           $this->rules['documentos.carteira_trabalho.estadoEmissao'] = 'required';
           $this->rules['documentos.carteira_trabalho.pagina_12'] = 'required';
           $this->rules['documentos.carteira_trabalho.pagina_13'] = 'required';
           $this->rules['documentos.carteira_trabalho.pagina_42'] = 'required';
           $this->rules['documentos.carteira_trabalho.pagina_43'] = 'required';
           $this->rules['documentos.carteira_trabalho.qcFrente'] = 'required';
           $this->rules['documentos.carteira_trabalho.qcVerso'] = 'required';
       }
   }

   public function all($keys = NULL)
   {
    return $this->sanitize();
}

public function sanitize()
{
    $request = parent::all();

    $request['dtNascimento'] = date_banco($request['dtNascimento']);
        // dd($request['documentos']['rg']['dtEmissao']);
    if(isset($request['documentos']['rg'])){
        $request['documentos']['rg']['dtEmissao'] = date_banco($request['documentos']['rg']['dtEmissao']);
    }

    if(isset($request['documentos']['carteira_trabalho'])){
     $request['documentos']['carteira_trabalho']['dtEmissao'] = date_banco( $request['documentos']['carteira_trabalho']['dtEmissao']);
 }
 if( $request['maiorIdade']){
    unset($request['parentesco']['responsavel']);
}

if( $request['estado_civil'] =! 1){
    unset($request['parentesco']['conjuge']);
}

if( isset($request['primeiro_emprego']) && $request['primeiro_emprego']  == 2){
    unset($request['documentos']['pis']);
}

if(isset($request['possui_filhos']) && $request['possui_filhos'] == 2){
    unset($request['parentesco']['filho']);
}

if(isset($request['parentesco']['responsavel'])){
    $request['parentesco']['responsavel']['dtNascimento'] = date_banco( $request['parentesco']['responsavel']['dtNascimento'] );

    $request['parentesco']['responsavel']['dtEmissaoRg'] = date_banco( $request['parentesco']['responsavel']['dtEmissaoRg'] );
}

if(isset($request['parentesco']['filho'])){
    foreach ($request['parentesco']['filho'] as $key => $value) {
        if(isset($request['parentesco']['filho'][$key]['cpf'])){
            $request['parentesco']['filho'][$key]['dtNascimento'] = date_banco($request['parentesco']['filho'][$key]['dtNascimento']);
        }
    }
}

return $request;
}
}