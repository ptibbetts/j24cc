<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Websites Controller
 *
 * @property \App\Model\Table\WebsitesTable $Websites
 *
 * @method \App\Model\Entity\Website[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebsitesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Games']
        ];
        $websites = $this->paginate($this->Websites);

        $this->set(compact('websites'));
    }

    /**
     * View method
     *
     * @param string|null $id Website id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $website = $this->Websites->get($id, [
            'contain' => ['Games']
        ]);

        $this->set('website', $website);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $website = $this->Websites->newEntity();
        if ($this->request->is('post')) {
            $website = $this->Websites->patchEntity($website, $this->request->getData());
            if ($this->Websites->save($website)) {
                $this->Flash->success(__('The website has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The website could not be saved. Please, try again.'));
        }
        $games = $this->Websites->Games->find('list', ['limit' => 200]);
        $this->set(compact('website', 'games'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Website id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $website = $this->Websites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $website = $this->Websites->patchEntity($website, $this->request->getData());
            if ($this->Websites->save($website)) {
                $this->Flash->success(__('The website has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The website could not be saved. Please, try again.'));
        }
        $games = $this->Websites->Games->find('list', ['limit' => 200]);
        $this->set(compact('website', 'games'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Website id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $website = $this->Websites->get($id);
        if ($this->Websites->delete($website)) {
            $this->Flash->success(__('The website has been deleted.'));
        } else {
            $this->Flash->error(__('The website could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
