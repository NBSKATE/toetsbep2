<?php

class Lessen extends Controller
{
    private $lesModel;

    public function __construct()
    {
        // We maken een object van de model class en stoppen dit in een $lesModel
        $this->lesModel = $this->model('Les');
    }

    public function index()
    {
        $result = $this->lesModel->getLessen();

        var_dump($result);

        $rows = "";

        foreach ($result as $lesInfo) {
            $dateTimeObj = new DateTimeImmutable(
                $lesInfo->DatumTijd,
                new DateTimeZone('Europe/Amsterdam')
            );
            // var_dump($dateTimeObj);
            $rows .= "<tr>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$dateTimeObj->format('H:i')}</td>
                        <td>{$lesInfo->LENA}</td>
                        <td></td>
                        <td>
                            <a href='" . URLROOT . "/lessen/topiclesson/{$lesInfo->LEID}'>
                            <img src='" . URLROOT . "/img/b_browse.png' alt='table picture'>
                            </a>
                        </td>
                      </tr>";
        }

        $data = [
            'title' => 'Overzicht lessen',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA
        ];
        $this->view('lessen/index', $data);
    }

    public function topicLesson($id = NULL)
    {

        $result = $this->lesModel->getTopics($id);
        var_dump($result);

        if ($result) {
            $dt = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
            $date = $dt->format('d-m-U');
            $time = $dt->format('H:i');
        } else {
            $date = "";
            $time = "";
            $id = "";
        }
        $rows = "";

        foreach ($result as $topic) {
            $rows .=  "<tr>
                         <td>{$topic->Onderwerp}</td>
                       </tr>";
        }

        $data = [
            'title' => 'Onderwerpen Les',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'lessonId' => $id
        ];
        $this->view('lessen/topiclesson', $data);
    }

    public function addTopic($id = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->lesModel->addTopic($_POST);

            $data = [
                'title' => 'test'
            ];

            $this->view('lessen/topiclessen', $data);
        } else {
            $data = [
                'title' => 'Onderwerp toevoegen',
                'id' => $id
            ];

            $this->view('lessen/addTopic', $data);
        }
    }
}
