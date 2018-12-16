<?php

	namespace App\Http\Controllers;

	use App\Models\dataModel;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Validation\ValidationException;
	use Nexmo\Call\Collection;

	/** Котроллер для транзакций
	 * Class transactionsController
	 * @package App\Http\Controllers
	 */
	class transactionsController extends Controller {

		public function index() {

		}

		/** Метод построения транзакций
		 *
		 * @param Request $request
		 */
		public function getTransactions( Request $request ) {
			try {

				$this->validate( $request, [
					'y' => 'integer',
					'm' => 'between:1,12',
				] );

				if ( empty( $request->get( 'y' ) ) || empty( $request->get( 'm' ) ) ) {

					$year  = date( 'Y' );
					$month = date( 'm' );
				} else {
					$year  = $request->get( 'y' );
					$month = str_pad( $request->get( 'm' ), 2, "0", STR_PAD_LEFT );

				}

				$data = dataModel::where( [
					[ 'date', '>=', "$year-$month-01 00:00:00" ],
					[ 'date', '<', ''.date( 'Y-m-d H:i:s', strtotime( "$year-$month-01 00:00:00 +1 month" ) ) ]
				] )->get();

				return $data;
			} catch ( ValidationException $e ) {
				return abort( '404' );
			} catch ( \Exception $e ) {
				return abort( '500' );
			}

		}

		/** Метод постороения формы и навигации
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Collection
		 */
		public function view( Request $request ) {
			try {
				DB::statement( DB::raw( "SET @@lc_time_names='ru_RU'" ) );
				$dates     = DB::table( 'data' )
				               ->select( DB::raw( 'YEAR(`date`)as year, MONTH(`date`)as month, MONTHNAME(date) AS month_name, COUNT(*) as count_rows' ) )
				               ->groupBy( 'year', 'month' )
				               ->orderBy( 'year', 'month' )->get()->toArray();
				$yearCount = array();
				foreach ( $dates as $date ) {
					if ( empty( $yearCount[ $date->year ] ) ) {
						$yearCount[ $date->year ]['count']  = $date->count_rows;
						$yearCount[ $date->year ]['data'][] = $date;

					} else {
						$yearCount[ $date->year ]['count']  += $date->count_rows;
						$yearCount[ $date->year ]['data'][] = $date;
					}

				}

				$rows = $this->getTransactions( $request );

				return view( 'home' )
					->with( 'data', $yearCount )
					->with( 'rows', $rows );
			} catch ( \Exception $e ) {
				return abort( '500' );
			}
		}


	}
