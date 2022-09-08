<?php 
    include('conexao.php'); //chama o arquivo e faz a conexão com o banco
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index.css">
        <title>Formulario Select</title> 
    </head>

    <body>

    <div class="box">
        <form method="get" action="index.php">

            <!-- DIV que faz o input e o botão !-->
            <div class="div-input">
                <input type="text" class="input-id" name="input-id" placeholder="Insira o ID" />
                <button onclick="resultado()"> Gerar Relatório </button>
            </div>

        </form>

        <?php
            if(!isset($_GET['input-id'])) //verifica se ja teve algum valor digitado
            {
            } 

            else 
            {
                $inputID = $_GET['input-id']; //recebe o valor digitado pelo usuario

                //codigo a ser rodado no sql
                $sql_proc = "SELECT numero_processo, proximo_prazo, arquivo FROM processos WHERE advogado_id ='$inputID'";
                $sql_nome = "SELECT nome, id FROM pessoas WHERE id = '$inputID' AND cliente = 0";

                $result_pros = $connection->query($sql_proc) or die("Erro de consulta"); //roda o codigo
                $result_nome = $connection->query($sql_nome) or die("Erro de consulta");

                if ($result_pros->num_rows == 0) //verifica se existe resultado para aquela pesquisa
                { 
                    echo "<p1 class='no_result'> Nenhum resultado encontrado </p1>"; 
                }
                else
                {
                    //Nome do advogado
                    while($row = $result_nome->fetch_assoc()) 
                    { 
                        echo "<h3 class='titulo'>";
                        echo " | Nome: "; echo $row['nome']; 
                        echo " | ID: "; echo $row['id']; echo " |";
                        echo "</h3>";
                    }

                    ?>
                    
                    <div class="div-table">
                        <table>

                        
                            <tr>
                                <th>Numero Processo</th>
                                <th>Proximo Prazo</th>
                                <th>Arquivo</th>
                            </tr>

                            <?php
                                //Processos do advogado
                                while($row = $result_pros->fetch_assoc())
                                {
                                    ?> 
                                    <tr>
                                        <td> <?php echo $row['numero_processo']; ?></td>
                                        <td> <?php echo $row['proximo_prazo'];   ?></td>
                                        <td align="Center"> <?php echo $row['arquivo'];         ?></td>
                                    </tr>
                                    <?php
                                }
                        ?>
                        
                        </table>
                    </div>

                    <?php
                }
            
            $connection->close();
            }
        ?>
    </div>

    </body>

</html>