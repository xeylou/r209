<?php
                // SI ON AJOUTE DES CATEGORIES LE CODE SUIVRA & AJOUTERA
                $req_ctg = 'SELECT * FROM categories';
                $res_ctg = $db->query($req_ctg);
                while ($data=$res_ctg->fetchArray()) {
                    echo '';
                }
                ?>