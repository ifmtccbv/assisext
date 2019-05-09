<?php

require_once 'sistema/geral/SiteView.class.php';
$siteView = new SiteView();

$html = '';
$html .= '<style> .auxilio li { margin-bottom: 5px; margin-left: 15px; } </style>';
$html .= $siteView->montaTitulo('Apresentação');
$html .=    '<div class="apresentacao"><p>O Programa de Assistência Estudantil do Instituto Federal de Educação,
            Ciência e Tecnologia de Minas Gerais consiste na concessão de benefícios aos
            estudantes regularmente matriculados e frequentes nos cursos presenciais ofertados
            pelo IFMG. Entre as ações do Programa, está a concessão de benefícios destinados
            aos estudantes que se encontram em situação de vulnerabilidade socioeconômica e
            que necessitam de apoio financeiro para permanecerem no Instituto.</p>

            <p>O Programa oferece aos estudantes, segundo critérios socioeconômicos, os
            seguintes auxílios:</p>

            <p> <ul class="auxilio">
                <li> <strong> Auxílio Moradia </strong> - Compreende a concessão de auxílio financeiro para moradia aos estudantes que atendam a critérios socioeconômicos. Destinado a estudantes cujo núcleo familiar não reside na cidade do campus onde este estuda.</li>
                <li> <strong> Auxílio Alimentação </strong> - Refere-se à concessão de auxílio financeiro para alimentação aos estudantes que comprovem carência socioeconômica.</li>
                <li> <strong> Auxílio Atividade </strong> - Refere-se à concessão de auxílio para realização de atividades do interesse do estudante e em consonância com as necessidades da instituição, que estejam preferencialmente relacionados à formação do estudante.</li>
                <li> <strong> Auxílio Creche </strong> - É um apoio financeiro não reembolsável, concedido mensalmente aos estudantes regularmente matriculados que têm filhos até 6 (seis) anos e que atendam a critérios socioeconômicos.</li>
                <li> <strong> Auxílio Transporte Municipal </strong> - Destinado aos estudantes que atendem a critérios socioeconômicos, trata-se da concessão de auxílio financeiro para que os mesmos se locomovam para o campus.</li>
                <li> <strong> Auxílio Transporte Intermunicipal </strong> - Destinado aos estudantes que atendem a critérios socioeconômicos, trata-se da concessão de auxílio financeiro para que os mesmos se locomovam diariamente de cidades vizinhas para a cidade do campus.</li>
            </ul></p>

            <p>Para concorrer aos auxílios ofertados, o estudante deve, primeiramente,
            acessar o edital do Programa e verificar quais os auxílios que cada campus oferece e
            qual o período para candidatar-se a eles. Em seguida, deve efetuar o preenchimento
            do respectivo questionário e todas as informações prestadas, como escolaridade,
            renda e bens dos membros do núcleo familiar, devem ser fornecidas com total
            veracidade. Lembrando que o questionário somente poderá ser preenchido durante os
            períodos de inscrições indicados no edital.</p>

            <p>Após o preenchimento do questionário, será realizada a análise dos
            indicadores sociais e econômicos do contexto familiar dos candidatos. Os selecionados
            dentro do número de benefícios disponíveis em cada campus serão contactados pelo e-mail 
            informado no cadastro. Neste e-mail, será indicada a relação de documentos para comprovar as informações 
            prestadas bem como data e local onde os documentos deverão ser entregues.</p></div>';

echo $html;

?>
