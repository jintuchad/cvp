<?php

use Cvp\Repos\Deal\DealRepository;
use Cvp\Repos\Dealpic\DealpicRepository;
use Cvp\Repos\Dealtab\DealtabRepository;
use Cvp\Repos\Dealoption\DealoptionRepository;
use Cvp\Repos\Promotion\PromotionRepository;

class DealController extends \BaseController {

	protected $dealRepo;
	protected $dealpicRepo;
	protected $dealtabRepo;
	protected $dealoptionRepo;
	protected $promotionRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @param DealRepository        $dealRepo
	 * @param DealpicRepository     $dealpicRepo
	 * @param DealtabRepository     $dealtabRepo
	 * @param DealoptionRepository  $dealoptionRepo
	 * @param PromotionRepository  $promotionRepo
	 *
	 * @return Controller
	 */
	public function __construct(DealRepository $dealRepo, DealpicRepository $dealpicRepo, DealtabRepository $dealtabRepo, DealoptionRepository $dealoptionRepo, PromotionRepository $promotionRepo)
	{
		$this->dealRepo = $dealRepo;
		$this->dealpicRepo = $dealpicRepo;
		$this->dealtabRepo = $dealtabRepo;
		$this->dealoptionRepo = $dealoptionRepo;
		$this->promotionRepo = $promotionRepo;
	}

	/**
	 * Show deal detail for a 'deal_link' (in the form of : 'promotions.id-deals.slug')
	 *
	 * @param  string  $deal_link
	 * @return Response
	 */
	public function detail($deal_link)
	{
		$deal = $this->dealRepo->getByDealLink($deal_link);

		$promotion = $this->promotionRepo->getByDealLink($deal_link);

		if (!$deal || !$promotion)
		{
			// TODO: provide message

			return Redirect::route('city-index');
		}

		$dealFeaturePics = $this->dealpicRepo->findDealFeaturePics($deal->id);

		$dealTabs = $this->dealtabRepo->findDealTabs($deal->id);

		$dealOptions = $this->dealoptionRepo->findDealOptions($deal->id);

		return View::make('deal.detail', compact('deal', 'promotion', 'dealFeaturePics', 'dealTabs', 'dealOptions'));
	}

}